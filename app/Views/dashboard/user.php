<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman User</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom, #ffecd2, #fcb69f);
            text-align: center;
            padding: 50px;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        }

        .dog-image {
            width: 100%;
            max-width: 350px;
            border-radius: 15px;
            transition: transform 0.3s ease;
        }

        .dog-image:hover {
            transform: rotate(-5deg) scale(1.1);
        }

        h1 {
            font-size: 2rem;
            color: #ff7f50;
        }

        p {
            font-size: 1.2rem;
            color: #666;
        }

        .bleee {
            color: #ff6f61;
            font-weight: bold;
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Ini adalah halaman <?= session()->get('nama') ?></h1>
        <p class="bleee">Bleee! 🐶</p>
        <!-- tombol logout -->
        <a href="/logout" class="btn btn-danger">Logout</a>
        <img src="https://place-puppy.com/400x400" alt="Anjing Melet" class="dog-image">
    </div>

    <script>
        // Toast message untuk user
        setTimeout(() => {
            alert('Selamat datang di halaman user! 🐕');
        }, 1000);
    </script>
</body>

</html>