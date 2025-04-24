<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Gold & Precious Metals</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .hero {
            background: url('{{ asset('images/gold-background.jpg') }}') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 100px 0;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .hero h1 {
            font-size: 4rem;
            margin-bottom: 20px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        .hero p {
            font-size: 1.5rem;
            margin-bottom: 40px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        .header-content {
            display: flex;
            align-items: center;
            margin-bottom: 20px; /* Add margin bottom for spacing */
        }
        .header-content img {
            height: 70px; /* Adjusted height */
            width: auto; /* Maintain aspect ratio */
            margin-right: 10px; /* Add space between logo and text */
        }
        .header-content span {
            font-size: 1.8rem; /* Adjusted font size */
            font-weight: bold;
            color: #d4af37;
        }
        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 25px;
            text-transform: uppercase;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-primary {
            background-color: #d4af37;
            color: white;
        }
        .btn-primary:hover {
            background-color: #c49c2d;
        }
        .btn-secondary {
            background-color: white;
            color: #d4af37;
            border: 2px solid #d4af37;
        }
        .btn-secondary:hover {
            background-color: #d4af37;
            color: white;
        }
    </style>
</head>
<body>
    
    <section class="hero">
        <div class="header-content">
            <img src="assets/img/logoLM.png" alt="Logo">
            <span>Gold & Precious Metals</span>
        </div>
        <div class="container mx-auto">
            <h1>Selamat Datang di Logam Mulia</h1>
            <p>Investasikan masa depan dengan produk emas dan logam mulia premium kami.</p>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-secondary">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary">
                            Register
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </section>

</body>
</html>
