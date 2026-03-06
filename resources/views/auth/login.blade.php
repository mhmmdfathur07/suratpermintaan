<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Sistem Permintaan Layanan</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        *{
            box-sizing:border-box;
        }

        body{
            margin:0;
            font-family: 'Segoe UI', sans-serif;
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            background:
                radial-gradient(circle at 20% 20%, rgba(255,255,255,0.15), transparent 40%),
                radial-gradient(circle at 80% 30%, rgba(255,255,255,0.12), transparent 45%),
                radial-gradient(circle at 30% 80%, rgba(255,255,255,0.10), transparent 50%),
                linear-gradient(135deg,#006e6b,#009688,#00b3a4);
            background-size: cover;
        }

        .login-wrapper{
            width:100%;
            max-width:950px;
            background:white;
            border-radius:22px;
            box-shadow:0 20px 50px rgba(0,0,0,0.25);
            overflow:hidden;
            display:flex;
        }

        /* LEFT PANEL */
        .login-left{
            background: linear-gradient(160deg,#006e6b,#009688);
            color:white;
            padding:50px;
            width:45%;
        }

        .logo-box{
            background: rgba(255,255,255,0.95);
            padding:14px 18px;
            border-radius:14px;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            width:fit-content;
            box-shadow:0 6px 18px rgba(0,0,0,0.2);
            margin-bottom:28px;
        }

        .logo{
            height:55px;
            width:auto;
            object-fit:contain;
        }

        .login-left h3{
            font-weight:800;
            line-height:1.2;
            margin-bottom:12px;
        }

        .login-left p{
            font-size:14px;
            line-height:1.7;
            opacity:0.95;
        }

        /* RIGHT PANEL */
        .login-right{
            width:55%;
            padding:50px;
        }

        .login-title{
            font-size:24px;
            font-weight:800;
            color:#006e6b;
        }

        .login-subtitle{
            font-size:14px;
            color:#6b8f8a;
            margin-bottom:28px;
        }

        .form-group{
            margin-bottom:18px;
        }

        .input-group-text{
            background:#eef5ff;
            border:1px solid #dbe6ff;
        }

        .form-control{
            border:1px solid #dbe6ff;
            background:#eef5ff;
            padding:12px;
        }

        .form-control:focus{
            box-shadow:none;
            border-color:#006e6b;
            background:#f5fbff;
        }

        .btn-login{
            background:#006e6b;
            border:none;
            color:white;
            padding:12px;
            border-radius:10px;
            font-weight:600;
            transition:.3s;
        }

        .btn-login:hover{
            background:#005854;
            transform:translateY(-1px);
            box-shadow:0 6px 16px rgba(0,0,0,0.15);
        }

        .login-footer{
            text-align:center;
            font-size:12px;
            color:#7a9a96;
            margin-top:22px;
        }

        @media(max-width:900px){
            .login-wrapper{
                flex-direction:column;
                max-width:420px;
            }
            .login-left,.login-right{
                width:100%;
            }
        }
    </style>
</head>

<body>

<div class="login-wrapper">

    <!-- LEFT PANEL -->
    <div class="login-left d-flex flex-column justify-content-center">

        <div class="logo-box">
            <img src="/assets/logo.png" class="logo" alt="Logo">
        </div>

        <h3>Sistem Permintaan Layanan</h3>
        <p>
            Sistem Informasi Rekam Medis  
            untuk pengelolaan permintaan layanan pasien  
            secara cepat, aman, dan terintegrasi.
        </p>
    </div>

    <!-- RIGHT PANEL -->
    <div class="login-right">

        <div class="login-title">Login Akun</div>
        <div class="login-subtitle">Masuk ke sistem untuk melanjutkan</div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- USERNAME -->
            <div class="form-group">
                <label class="form-label fw-semibold">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" name="email" class="form-control" required placeholder="Masukkan username">
                </div>
            </div>

            <!-- PASSWORD -->
            <div class="form-group">
                <label class="form-label fw-semibold">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control" required>
                </div>
            </div>

            <!-- BUTTON -->
            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-login">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </button>
            </div>

            <div class="login-footer">
                © 2026 Sistem Informasi Rekam Medis
            </div>
        </form>

    </div>

</div>

</body>
</html>