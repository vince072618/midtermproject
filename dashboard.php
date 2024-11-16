<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alcohol POS Dashboard</title>
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #d3d3d3; /* Light gray background */
            color: #4d2600; /* Dark copper text */
        }

        /* Navbar styles */
        .navbar {
            background-color: #b87333; /* Copper background */
            color: #f1f1f1;
            padding: 1em;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar .logo {
            font-weight: bold;
            color: #ffffff; /* White text for contrast */
        }

        .navbar a {
            color: #ffffff; /* White links in navbar */
            margin-left: 1em;
            text-decoration: none;
            transition: color 0.3s;
        }

        .navbar a:hover {
            color: #d3d3d3; /* Light gray on hover */
        }

        /* Dashboard content styles */
        .dashboard {
            padding: 2em;
            max-width: 400px;
            margin: auto;
            text-align: center;
        }

        .dashboard h1 {
            color: #b87333; /* Copper color for heading */
        }

        .product-selection, .checkout {
            margin-top: 20px;
            background-color: #e0e0e0; /* Slightly lighter gray for sections */
            padding: 25px; /* Increased padding for more space */
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1); /* Soft shadow for depth */
            width: 300px; /* Fixed width for consistency */
            margin: 0 auto; /* Center alignment */
        }

        .product-selection label, .checkout label {
            color: #4d2600; /* Dark copper text */
            font-weight: bold;
            display: block;
            text-align: left;
        }

        .product-selection select, .product-selection input, .checkout input {
            padding: 14px; /* Increased padding for input fields and select */
            margin-top: 10px;
            width: 100%; /* Full width within fixed container */
            background-color: #ffffff; /* White input background */
            color: #4d2600; /* Dark copper text */
            border: 1px solid #b87333; /* Copper border */
            border-radius: 5px;
        }

        .product-selection select:focus, .product-selection input:focus, .checkout input:focus {
            border-color: #b87333; /* Copper color on focus */
            box-shadow: 0 0 8px rgba(184, 115, 51, 0.5); /* Copper glow */
        }

        /* Checkout button styles */
        .checkout button {
            background-color: #b87333; /* Copper button background */
            color: #ffffff; /* White text */
            padding: 14px; /* Matching padding with inputs */
            width: 100%; /* Full width within fixed container */
            border: none;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 15px;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .checkout button:hover {
            background-color: #a0602b; /* Darker copper on hover */
        }

        /* Message styles */
        .warning {
            font-weight: bold;
            margin-top: 10px;
        }

        .warning.success {
            color: #4caf50; /* Success color */
        }

        .warning.error {
            color: #b87333; /* Copper color for error */
        }
    </style>
</head>
<body>

<!-- Navigation Bar -->
<div class="navbar">
    <div class="logo">Computer Parts</div>
    <div>
        <a href="history.php">History Log</a>
        <a href="dashboard.php">Home</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<!-- Dashboard Section -->
<div class="dashboard">
    <h1>Vincski- Computer Products</h1>

    <!-- Product Selection -->
    <div class="product-selection">
        <label for="product">Select Product:</label>
        <select id="product">
            <option value="1" data-price="15">Mechanical Keyboard- $150</option>
            <option value="2" data-price="10">Razer Mouse - $101</option>
            <option value="3" data-price="12">Deep Cool Case - $80</option>
            <option value="4" data-price="18">Msi Monitor - $180</option>
            <option value="5" data-price="14">Graphics Card RTX 4060 - $1400</option>
            <option value="6" data-price="16">Cpu Cooler Deepcool - $160</option>
            <option value="7" data-price="8">SSD 500GB - $89</option>
            <option value="8" data-price="5">Printer - $100</option>
            <option value="9" data-price="7">Microphones - $70</option>
            <option value="10" data-price="20">Headset MSI- $200</option>
        </select>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" min="1" placeholder="Enter quantity">
    </div>

    <!-- Checkout Section -->
    <div class="checkout">
        <label for="payment">Payment Amount:</label>
        <input type="number" id="payment" placeholder="Enter payment amount">

        <button onclick="processTransaction()">Checkout</button>

        <div id="message" class="warning"></div>
    </div>
</div>

<script>
    // JavaScript to handle POS logic
    function processTransaction() {
        const product = document.getElementById("product");
        const productId = product.value;
        const quantity = parseInt(document.getElementById("quantity").value);
        const payment = parseFloat(document.getElementById("payment").value);
        const message = document.getElementById("message");

        // Validate inputs
        if (isNaN(quantity) || isNaN(payment) || quantity <= 0 || payment <= 0) {
            message.style.color = '#b87333'; /* Copper color for error */
            message.innerText = 'Please enter valid quantity and payment amount.';
            return;
        }

        // Send transaction data to server
        fetch('process_transaction.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `product_id=${productId}&quantity=${quantity}&payment=${payment}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                message.style.color = '#4caf50'; /* Green for success */
                message.innerText = `Transaction successful! Change: $${data.change.toFixed(2)}`;
            } else {
                message.style.color = '#b87333'; /* Copper color for error */
                message.innerText = data.message;
            }
        })
        .catch(error => {
            message.style.color = '#b87333'; /* Copper color for error */
            message.innerText = 'Error processing transaction. Please try again.';
        });
    }
</script>

</body>
</html>
