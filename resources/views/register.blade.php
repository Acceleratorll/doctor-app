<!DOCTYPE html>
<html lang="en">
    <head>
        <title>register</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- custom CSS -->
        <link rel="stylesheet" href="style.css">
        <!-- Function JS -->
        <script type = "text/javascript" src="function.js"></script>  

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        <!-- font awesome cdn link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600&display=swap");
            * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            -webkit-box-sizing: border-box;
                    box-sizing: border-box;
            text-decoration: none;
            outline: none;
            border: none;
            text-transform: capitalize;
            -webkit-transition: all .2s linear;
            transition: all .2s linear;
            }

            html {
            font-size: 62.5%;
            overflow-x: hidden;
            }

            section {
            padding: 2rem 9%;
            }

            .heading {
            text-align: center;
            background: #21cdc0;
            }

            .heading h1 {
            font-size: 3rem;
            text-transform: uppercase;
            color: #fff;
            }

            .heading p {
            color: #fff;
            padding-top: .7rem;
            font-size: 1.7rem;
            }

            .heading p a {
            color: #fff;
            }

            .heading p a:hover {
            color: #21cdc0;
            }

            .title {
            font-size: 3rem;
            color: #333;
            margin-bottom: 2rem;
            text-align: center;
            padding: 0 1rem;
            }

            .btn {
            display: inline-block;
            margin-top: 1rem;
            padding: .8rem 2.8rem;
            font-size: 1.7rem;
            color: #333;
            border: 0.2rem solid #333;
            background: none;
            cursor: pointer;
            border-radius: .5rem;
            }

            .btn:hover {
            background: #333;
            color: #fff;
            }


            #menu-btn {
            display: none;
            }


            .login-form form,
            .register-form form {
            margin: 1rem auto;
            max-width: 40rem;
            border-radius: .5rem;
            border: 0.2rem solid #333;
            padding: 2rem;
            text-align: center;
            }

            .login-form form h3,
            .register-form form h3 {
            font-size: 2.2rem;
            text-transform: uppercase;
            color: #333;
            margin-bottom: .7rem;
            }

            .login-form form .inputBox,
            .register-form form .inputBox {
            margin: 1rem 0;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            border-radius: .5rem;
            background: #eee;
            padding: .5rem 1rem;
            -webkit-box-align: center;
                -ms-flex-align: center;
                    align-items: center;
            gap: 1rem;
            }

            .login-form form .inputBox span,
            .register-form form .inputBox span {
            color: #666;
            margin-left: 1rem;
            font-size: 2rem;
            }

            .login-form form .inputBox input ,
            .register-form form .inputBox input {
            width: 100%;
            padding: 1rem;
            background: none;
            font-size: 1.5rem;
            color: #666;
            text-transform: none;
            }
            
            .login-form form .inputBox option,
            .register-form form .inputBox option{
            width: 100%;
            padding: 1rem;
            background: none;
            font-size: 1.5rem;
            color: #666;
            text-transform: none;
            } 

            .login-form form .flex,
            .register-form form .flex {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
                -ms-flex-align: center;
                    align-items: center;
            gap: .5rem;
            padding: 1rem 0;
            margin-top: 1rem;
            }

            .login-form form .flex label,
            .register-form form .flex label {
            font-size: 1.5rem;
            cursor: pointer;
            color: #666;
            }

            .login-form form .flex a,
            .register-form form .flex a {
            font-size: 1.5rem;
            color: #666;
            margin-left: auto;
            }

            .login-form form .flex a:hover,
            .register-form form .flex a:hover {
            color: #21cdc0;
            }

            .login-form form input[type="submit"],
            .register-form form input[type="submit"] {
            background: #333;
            color: #fff;
            }

            .login-form form input[type="submit"]:hover,
            .register-form form input[type="submit"]:hover {
            background: #21cdc0;
            }

            .login-form form .btn,
            .register-form form .btn {
            width: 100%;
            }
        </style>
        
        <!-- header section  -->
        <section class="heading">
            <h1>Account</h1>
            <p> register </p>
        </section>

        <!-- register form section starts -->
        <section class="register-form">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="{{ route('register') }}">
            @csrf
                <h3>register now</h3>
                <div class="inputBox">
                    <span class="fas fa-user"></span>
                    <input type="text" name="name" placeholder="enter your name" id="">
                </div>
                <div class="inputBox">
                    <span class="fas fa-user"></span>
                    <input type="text" name="username" placeholder="enter your username" id="">
                </div>
                <div class="inputBox">
                    <span class="fas fa-user"></span>
                    <input type="text" name="email" placeholder="enter your email" id="">
                </div>
                <div class="inputBox">
                    <span class="fas fa-envelope"></span>
                    <input type="date" name="birth_date" placeholder="enter your date of birth" id="" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="inputBox">
                    <span class="fas fa-user"></span>
                    <select class="form-control" name="gender">
                        <option value="" disabled selected hidden>enter your gender</option>
                        <option>Pria</option>
                        <option>Wanita</option>
                    </select>
                </div>
                <div class="inputBox">
                    <span class="fas fa-address-book"></span>
                    <input type="text" name="address" placeholder="enter your addres" id="">
                </div>
                <div class="inputBox">
                    <span class="fas fa-phone"></span> 
                    <input type="number" name="phone" placeholder="enter your handphone" id="">
                </div>
                <div class="inputBox">
                    <span class="fas fa-phone"></span> 
                    <input type="number" name="height" placeholder="enter your height(optional)" id="">
                </div>
                <div class="inputBox">
                    <span class="fas fa-phone"></span> 
                    <input type="number" name="weight" placeholder="enter your weight(optional)" id="">
                </div>
                <div class="inputBox">
                    <span class="fas fa-lock"></span>
                    <input type="password" name="password" placeholder="enter your password" id="">
                </div>
                <div class="inputBox">
                    <span class="fas fa-lock"></span>
                    <input type="password" name="confirm_password" placeholder="confirm your password" id="">
                </div>
                <input type="submit" value="sign up" class="btn">
                <a href="{{ __('Login') }}" class="btn">already have an account</a>
            </form>
        </section>
        <!-- register form section ends -->

    </body>
</html>
