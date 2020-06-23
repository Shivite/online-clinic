<?php
namespace App\Http\Controllers;
use App\Category;
use App\Notifications\AuthorPostApproved;
use Illuminate\Support\Facades\DB;
use App\Notifications\NewPostNotify;
use App\Subscriber;
use App\Label;
use App\Article;
use App\ArticleRevision;
use App\SeoTags;
use Session;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
class ArticleController extends Controller
{
    public function index()
    {
          $revisedFields = new \stdClass();
          if(Auth::user()->isAdmin())
            $articles = Article::withTrashed()->latest()->get();
          else
            $articles = Auth::user()->articles()->latest()->get();
          foreach($articles as $article){
              foreach($article->revision as $revesions){
                  foreach(json_decode($revesions->action_fields) as $key => $val){
                      $revisedFields->$key = $val;
                  }
              }
          }
          return view('article.index', compact('articles', 'revisedFields'));
    }

    public function create()
    {
        $categories = Category::all();
        $labels     = Label::all();
        $article    = new Article();
        return view('article.create', compact('categories', 'labels', 'article'));
    }

    public function store(Request $request)
    {
        $article   = new Article();
        $validator = Validator::make($request->all(), $this->rules($article, 'store'));
        if ($validator->fails()) {
            $errors     = $validator->errors();
            return json_encode(array('response' => 400, 'errors' => $errors));
        }
        ## Image upload
        $slug                 = str_slug($request->title);
        $imgName              = $this->imageUpload($request->file('image'));
        $article->user_id     = Auth::id();
        $article->title       = $request->title;
        $article->image       = $imgName;
        $article->slug        = $slug;
        $article->body       = $request->body;
        $article->status      = isset($request->status);
        $article->is_approved = (Auth::user()->isAdmin()) ? true : false;
        if($article->save()){
          $article->categories()->attach($request->categories);
          $article->labels()->attach($request->labels);
          return json_encode(array('response' => 200,'success' => "Article created Successfully"));
        }else{
          return json_encod(array('response' => 400));
        }
    }

    public function show(Article $article)
    {
      $categories         =     Category::all();
      $labels             =     Label::all();
      $article            =     Article::find($article->id);
      return view('article.show', compact('article', 'categories', 'labels'));
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        $labels     = Label::all();
        return view('article.edit', compact('categories', 'labels', 'article'));
    }

    public function update(Request $request, Article $article)
    {
        $validator = Validator::make($request->all(), $this->rules($article, 'update'));
        if ($validator->fails()) {
            $errors     = $validator->errors();
            return json_encode(array('response' => 400, 'errors' => $errors));
        }
        ## Image upload
        $slug = str_slug($request->title);
        $image_params = $request->file('image');
        if(isset($image_params)) {
            $imgName        = $this->imageUpload($image_params);
            $article->image = $imgName;
        }
        $article->user_id = Auth::id();
        $article->title = $request->title;
        $article->slug = $slug;
        $article->body = $request->body;
        $article->status = (isset($request->status)) ? true : false;
        if($article->save()){
          $article->categories()->sync($request->categories);
          $article->labels()->sync($request->labels);
          return json_encode(array('response' => 200,'success' => "Label Updated Successfully"));
        }else{
          return json_encode(array('response' => 400));
        }
    }
    //get pending article for approval on get Request
    public function pending(){
      $articles = Article::where('is_approved',false)->get();
      return view('article.index', compact('articles'));
    }
    //pending request function end
    //aprove article put fucntioin
    public function approve($id){
      if(!Auth::user()->isAdmin()) $this->notAuthorised();
      $article = Article::find($id);
      if($article->is_approved == false){
          $article->is_approved = true;
          $article->save();
          Toastr::success('Article approved successfully!', 'Success');
      }else{
          Toastr::info('Requested article is already approved', 'info');
      }
      return redirect()->back();
    }
    //approve article function end
    //forntend single article detial page
     public function details($slug){
      $article = Article::where('slug', $slug)->approved()->published()->first();
      $checkCount = 'article_' . $article->id;
      if (!Session::has($checkCount)) {
            Session::put($checkCount,1);
            $article->increment('total_view');
        }
      $seoTags = SeoTags::find($article->id);
      if ($seoTags == null) {
        $seoTags = new SeoTags;
      }
      $randomArticles = Article::all()->random(3);
      if ($randomArticles == null) {
        $randomArticles = new Article();
      }
      $view = 'front';
      return view('articles.article-details', compact('article', 'randomArticles', 'seoTags', 'view'));
    }
    //frontend show detail function  end
    public function destroy(Article $article)
    {
        if (Storage::disk('public')->exists('article/' . $article->image)) {
            Storage::disk('public')->delete('article/' . $article->image);
        }
        $article->categories()->detach();
        $article->delete();
        //deletion record data will revised with edit revision.
        Toastr::success('Article Successfully Deleted !', 'Success');
        return redirect()->back();
    }

    public function restore(Request $request, $id)
    {
      if(!Auth::user()->isAdmin()) $this->notAuthorised();
      Article::withTrashed()->find($id)->restore();
      $articles = Article::withTrashed()->latest()->get();
      return view('article.index', compact('articles'));
     }

    public function revision($id){
        if(!Auth::user()->isAdmin()) $this->notAuthorised();
        $articles = Article::latest()->get();
        return view('article.revision', compact('articles'));
    }
    //creating validation rules
    public function rules($atricle, $method)
    {
        $inputs = [];
        if($method == 'update'){
            $inputs['image']      =   ($atricle->ifImageNotInDb()) ? 'required|image|mimes:jpeg,bmp,png,jpg' :'';
            $inputs['title']      =   'required';
        }
        else{
            $inputs['image']      =   'required';
            $inputs['title']      =   'required|unique:articles|max:255';
        }
        $inputs['labels']         =   'required';
        $inputs['categories']     =   'required';
        $inputs['body']           =   'required';
        return $inputs;
    }
    public function imageUpload($img){
        if (isset($img)) {
            $imgName = uniqid() . '.' . $img->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('article')) {
                Storage::disk('public')->makeDirectory('article');
            }
            $articleImage = Image::make($img)->resize(1200, 600)->save($imgName, 90);
            Storage::disk('public')->put('article/' . $imgName, $articleImage);
        } else {
            $imgName = "article-image.png";
        }
        return $imgName;
    }

    public function notAuthorised()
    {
         Toastr::Error('You are not authorised for this action :)' ,'Error');
         return abort(404);
    }
}
