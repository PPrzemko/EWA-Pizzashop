<!DOCTYPE html>
<html>
<head>
	<title>Simple Card Design</title>
    <style>
        .card-container {
            display: flex;
            justify-content: space-between;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            width: 300px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            margin-right: 10px;
        }

        .card:last-child {
            margin-right: 0;
        }

        .card h2 {
            margin-top: 0;
        }

        .card p {
            margin-bottom: 0;
        }

        /* Media query for mobile devices */
        @media (max-width: 768px) {
            .card-container {
                flex-wrap: wrap;
                justify-content: center;
            }

            .card {
                margin-right: 0;
                margin-bottom: 10px;
            }
        }
    </style>
	<script>
        // JavaScript code to handle the card click event
        function redirectToURL(url) {
            window.location.href = url;
        }
	</script>
</head>
<body>
<h1>Ultimate Pizza Shop</h1>
<div class="card-container">
    <div class="card" onclick="redirectToURL('order.php')">
        <h2>New order</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ac libero ut dui accumsan mattis. Aliquam erat volutpat.</p>
    </div>
    <div class="card" onclick="redirectToURL('customer.php')">
        <h2>Current Order status</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ac libero ut dui accumsan mattis. Aliquam erat volutpat.</p>
    </div>
    <div class="card" onclick="redirectToURL('driver.php')">
        <h2>Driver</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ac libero ut dui accumsan mattis. Aliquam erat volutpat.</p>
    </div>
    <div class="card" onclick="redirectToURL('baker.php')">
        <h2>Baker</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ac libero ut dui accumsan mattis. Aliquam erat volutpat.</p>
    </div>
</div>
</body>
</html>
