<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        
        body {
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            background-color: #fcf8fb; /* Surface color */
            margin: 0;
            padding: 0;
            color: #333333;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .email-wrapper {
            width: 100%;
            background-color: #fcf8fb;
            padding: 40px 0;
        }

        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(172, 51, 35, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #ac3323 0%, #d84534 100%);
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .body {
            padding: 40px 30px;
        }

        .body h2 {
            color: #ac3323;
            margin-top: 0;
            font-size: 20px;
            font-weight: 600;
        }

        .body p {
            font-size: 15px;
            line-height: 1.6;
            color: #555555;
            margin: 0 0 20px 0;
        }

        .button-wrapper {
            text-align: center;
            margin: 30px 0;
        }

        .button {
            display: inline-block;
            padding: 14px 28px;
            background-color: #ac3323;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            box-shadow: 0 4px 6px rgba(172, 51, 35, 0.2);
            transition: all 0.3s ease;
        }

        .footer {
            background-color: #f9f9f9;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #eeeeee;
        }

        .footer p {
            margin: 0;
            font-size: 13px;
            color: #888888;
        }

        .footer a {
            color: #ac3323;
            text-decoration: none;
        }

        /* Utilidades */
        .text-center { text-align: center; }
        .mt-0 { margin-top: 0; }
        .mb-0 { margin-bottom: 0; }
        .text-bold { font-weight: bold; }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
                <td class="header">
                    <h1>Numelabs</h1>
                </td>
            </tr>
            <tr>
                <td class="body">
                    @yield('content')
                </td>
            </tr>
            <tr>
                <td class="footer">
                    <p>&copy; {{ date('Y') }} Numelabs. Todos los derechos reservados.</p>
                    <p>Si tienes dudas, contáctanos a <a href="mailto:soporte@numelabs.com">soporte@numelabs.com</a></p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
