Laravel
VueJS
FrontEnd
PHP
Others
About
5 Balloons5 Balloons




Tutorial : Multi Page / Step Form in Laravel with Validation
In LaravelApril 19, 20188346 Views tgugnani
Multi Page / Step Form in Laravel with Validation


In this tutorial we will go over Example of Multi Page / Step Form in Laravel with Validation. This tutorial does not use any javascript component to create multi step form.

Instead we will create multiple form pages and will use Laravel session to save the intermediate data.

Before starting on to this tutorial make sure you have a Laravel Setup Ready and you have connected it to a Database. You can take help from below tutorials for the setup to get started.

How to Install Laravel with XAMPP ( I am using Laravel 5.6 for this Project)
Connecting your Project to Database in Laravel
We are creating a Multi Page Form to Insert products into the database. You can use this example for any of your Multi-Step Form Submission with Validation in Laravel.



To give a brief about the Multi-Step Form. The Form will consist of three pages before the results are stroed in the database

First page will have the form fields to get basic information about the product (name, description etc.)
Second page will have the ability to upload image for the product
Third page is a review screen where user can see the information added and can submit the Form to database.
Once you are ready with the setup, Let’s dive into the steps.



Create Model, Controller and a Migration File.
Let’s start with Creating a Model, Controller and a Migration File for our Form Submission Example. Go to Terminal (Command Line) and Navigate to your project root directory.

Run following artisan command.

php artisan make:model Product -c -m
This artisan command will generate a Model file Product.php and since we have appended the command with additional parameters it will also generate a Controller ProductController.php and a migration file create_products_table.php



Here is how the File Looks

Product.php will be generated under app directory.

Product Model File Blank


ProductController.php will be generated under app > Http > Controllers directory

ProductController blank file
create_products_table.php migration file will be created under database > migrations folder.

products migration file.
Generate Database Table
As the next step, Let’s update our migration file to include the additional fields to store the Product properties, we will use this migration file to generate a database table for our example project.

Open create_products_table.php migration file and update the up() function as given below to add additional product parameters.

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('company');
            $table->longText('description');
            $table->float('amount');
            $table->boolean('available');
            $table->string('productimg');
            $table->timestamps();
        });
    }
Now open your terminal, move to project root directory and run the following command to generate database tables form migration files.

php artisan migrate
php artisan migrate command
This will generate products table in the database along with the other default tables provided by Laravel.

Here is how the generated products table structure looks

products table structure multi-step laravel
Create Routes, Controller Method and Blade Page for Step 1 of Multi-Step Process
The first page of multi page Laravel form will have form fields to input information about the product.This will require a route entry , a corresponding Controller Method and a View file that will be returned by the Controller. Let’s do it one by one.



Open your web.php route file located under routes folder and add following entry into the file.

Route::get('/products/create-step1', 'ProductController@createStep1');
Route::post('/products/create-step1', 'ProductController@postCreateStep1');
These route entries will handle the show form as well as form post method, Let’s go ahead and add corresponding controller methods

    /**
     * Show the step 1 Form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStep1(Request $request)
    {
        $product = $request->session()->get('product');
        return view('products.create-step1',compact('product', $product));
    }

    /**
     * Post Request to store step1 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateStep1(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|unique:products',
            'amount' => 'required|numeric',
            'company' => 'required',
            'available' => 'required',
            'description' => 'required',
        ]);

        if(empty($request->session()->get('product'))){
            $product = new Product();
            $product->fill($validatedData);
            $request->session()->put('product', $product);
        }else{
            $product = $request->session()->get('product');
            $product->fill($validatedData);
            $request->session()->put('product', $product);
        }

        return redirect('/products/create-step2');

    }
createStep1 function is to display step-1 form page to the user and postCreateStep1 method will handle the post request from the step-1 form. The data is validated using Laravel’s inbuilt validation system and then stored into the session. User is then redirected to step-2 form page.

Create a new file create-step1.blade.php under resources > views > products and add following contents to create a HTML form.

@extends('layout.layout')

@section('content')
    <h1>Add New Product - Step 1</h1>
    <hr>
    <form action="/products/create-step1" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title">Product Name</label>
            <input type="text" value="{{{ $product->name or '' }}}" class="form-control" id="taskTitle"  name="name">
        </div>
        <div class="form-group">
            <label for="description">Product Company</label>
            <select class="form-control" name="company">
                <option {{{ (isset($product->company) && $product->company == 'Apple') ? "selected=\"selected\"" : "" }}}>Apple</option>
                <option {{{ (isset($product->company) && $product->company == 'Google') ? "selected=\"selected\"" : "" }}}>Google</option>
                <option {{{ (isset($product->company) && $product->company == 'Mi') ? "selected=\"selected\"" : "" }}}>Mi</option>
                <option {{{ (isset($product->company) && $product->company == 'Samsung') ? "selected=\"selected\"" : "" }}}>Samsung</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Product Amount</label>
            <input type="text"  value="{{{ $product->amount or '' }}}" class="form-control" id="productAmount" name="amount"/>
        </div>
        <div class="form-group">
            <label for="description">Product Available</label><br/>
            <label class="radio-inline"><input type="radio" name="available" value="1" {{{ (isset($product->available) && $product->available == '1') ? "checked" : "" }}}> Yes</label>
            <label class="radio-inline"><input type="radio" name="available" value="0" {{{ (isset($product->available) && $product->available == '0') ? "checked" : "" }}}> No</label>
        </div>
        <div class="form-group">
            <label for="description">Product Description</label>
            <textarea type="text"  class="form-control" id="taskDescription" name="description">{{{ $product->description or '' }}}</textarea>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button type="submit" class="btn btn-primary">Add Product Image</button>
    </form>
@endsection
Once you have completed these steps, navigate to /products/create-step1 url of your project. You should be able to see a Create products form in your application.

Multi page Laravel step-1
Create Routes, Controller Method and Blade Page for Step 2 of Multi-Step Process
Let’s go ahead and create necessary code to create second page of our multi step form in laravel.

Open your web.php route file located under routes folder and add following entry into the file.

Route::get('/products/create-step2', 'ProductController@createStep2');
Route::post('/products/create-step2', 'ProductController@postCreateStep2');
Route::post('/products/remove-image', 'ProductController@removeImage');
These route entries will handle the show form as well as form post method, Let’s go ahead and add corresponding controller methods

 /**
     * Show the step 2 Form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStep2(Request $request)
    {
        $product = $request->session()->get('product');
        return view('products.create-step2',compact('product', $product));
    }

    /**
     * Post Request to store step1 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateStep2(Request $request)
    {
        $product = $request->session()->get('product');
        if(!isset($product->productImg)) {
            $request->validate([
                'productimg' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $fileName = "productImage-" . time() . '.' . request()->productimg->getClientOriginalExtension();

            $request->productimg->storeAs('productimg', $fileName);

            $product = $request->session()->get('product');

            $product->productImg = $fileName;
            $request->session()->put('product', $product);
        }
        return redirect('/products/create-step3');

    }

    /**
     * Show the Product Review page
     *
     * @return \Illuminate\Http\Response
     */
    public function removeImage(Request $request)
    {
        $product = $request->session()->get('product');
        $product->productImg = null;
        return view('products.create-step2',compact('product', $product));
    }
Create a new file create-step2.blade.php under resources > views > products and add following contents to create a HTML form for second page of multi-step form.

@extends('layout.layout')

@section('content')
    <h1>Add New Product - Step 2</h1>
    <hr>
    @if(isset($product->productImg))
    Product Image:
    <img alt="Product Image" src="/storage/productimg/{{$product->productImg}}"/>
    @endif
    <form action="/products/create-step2" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <h3>Upload Product Image</h3><br/><br/>

        <div class="form-group">
            <input type="file" {{ (!empty($product->productImg)) ? "disabled" : ''}} class="form-control-file" name="productimg" id="productimg" aria-describedby="fileHelp">
            <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
        </div>
        <button type="submit" class="btn btn-primary">Review Product Details</button>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form><br/>
    @if(isset($product->productImg))
    <form action="/products/remove-image" method="post">
        {{ csrf_field() }}
    <button type="submit" class="btn btn-danger">Remove Image</button>
    </form>
    @endif
@endsection


Once you have completed these steps, enter information in step-1 of create product form and you should be redirected to step-2 page which should look like below.

multi step page 2 laravel
If you face difficulty in uploading the file / images and making them public, Please follow steps in following tutorial Example of File Upload with Validation in Laravel 5.6

Create Routes, Controller Method and Blade Page for Step 3 of Multi-Step Process
Let’s go ahead and create necessary code to create third page of our multi step form in laravel. In this step user can review the information added in first two steps and if required can go back to edit the information.



Open your web.php route file located under routes folder and add following entry into the file.

Route::get('/products/create-step3', 'ProductController@createStep3');
Route::post('/products/store', 'ProductController@store');
These route entry will handle the GET request to the review page of our multi step form and will also handle the final POST request to put data into database.

Open your ProductController.php and add corresponding controller methods into the database.

    /**
     * Show the Product Review page
     *
     * @return \Illuminate\Http\Response
     */
    public function createStep3(Request $request)
    {
        $product = $request->session()->get('product');
        return view('products.create-step3',compact('product',$product));
    }

    /**
     * Store product
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = $request->session()->get('product');
        $product->save();
        return redirect('/products');
    }
Create a new file create-step3.blade.php under resources > views > products and add following contents to create a HTML form for second page of multi-step form.

@extends('layout.layout')

@section('content')
    <h1>Add New Product - Step 3</h1>
    <hr>
    <h3>Review Product Details</h3>
    <form action="/products/store" method="post" >
        {{ csrf_field() }}
        <table class="table">
            <tr>
                <td>Product Name:</td>
                <td><strong>{{$product->name}}</strong></td>
            </tr>
            <tr>
                <td>Product Amount:</td>
                <td><strong>{{$product->amount}}</strong></td>
            </tr>
            <tr>
                <td>Product Company:</td>
                <td><strong>{{$product->company}}</strong></td>
            </tr>
            <tr>
                <td>Product Available:</td>
                <td><strong>{{$product->available ? 'Yes' : 'No'}}</strong></td>
            </tr>
            <tr>
                <td>Product Description:</td>
                <td><strong>{{$product->description}}</strong></td>
            </tr>
            <tr>
                <td>Product Image:</td>
                <td><strong><img alt="Product Image" src="/storage/productimg/{{$product->productImg}}"/></strong></td>
            </tr>
        </table>
        <a type="button" href="/products/create-step1" class="btn btn-warning">Back to Step 1</a>
        <a type="button" href="/products/create-step2" class="btn btn-warning">Back to Step 2</a>
        <button type="submit" class="btn btn-primary">Create Product</button>
    </form>
@endsection
Once you upload image in the second space and move to review the information added. You should be redirected to the third and final step and it should look something like below

multi-step-3-laravel
Click on Create Product and it should trigger the store method of the ProductController and the information should have be added to the database.

Show All Products
As a bonus, Let’s create a index page, where we will show all the products.

Open your web.php route file and add following entry for the index page.

Route::get('/products', 'ProductController@index');
Add the corresponding index method to ProductController

 /**
     * Display a listing of the prducts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index',compact('products',$products));
    }
We make use of Eloquent all() method to get all the products in the database. Further we make use of compact method to pass the products object to index page.

Create a new page index.blade.php and put following contents into the file.

@extends('layout.layout')

@section('content')
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Product Name</th>
            <th scope="col">Product Description</th>
            <th scope="col">Company</th>
            <th scope="col">Amount</th>
            <th scope="col">Available</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <th scope="row">{{$product->id}}</th>
                <td>{{$product->name}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->company}}</td>
                <td>{{$product->amount}}</td>
                <td>{{$product->available ? 'Yes' : 'No'}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
Demo


I have used Bootstrap Template Layout integration in this project, You can Integrate Bootstrap into your Laravel Application for similar User Interface.



If you found this tutorial helpful and if you have any questions, Let me know in comments. You might also find other related tutorials useful.

Tutorial – Simple CRUD Operations in Laravel 5.5
Laravel’s Out of Box Authentication Tutorial


Site Footer
About Me
Author
Hey, I’m Tushar, a full stack software engineer. I write about my acquired knowledge of web-development, the motive of this blog is to document my learings and to help the viewers on the similar journey.

If the content of this blog helped you, and you want to help me remove Ads from the website, Please support

© 5Balloons.info All Rights Reserved.
