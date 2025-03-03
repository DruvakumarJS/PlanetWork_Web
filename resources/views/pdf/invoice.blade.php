<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        .container {
            margin: 20px;
        }
        /* Table for Header */
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-table td {
            vertical-align: top;
            padding: 10px;
        }
        .company-logo {
            max-width: 150px;
        }
        /* Billing & Shipping Address */
        .address-table {
            width: 100%;
            margin-top: 30px;
            margin-bottom: 30px;
        }
        .address-table td {
            width: 50%;
            vertical-align: top;
            padding: 5px;
        }
        /* Items Table */
        .items-table {
            width: 100%;
            margin-top: 20px;
            border: 1px solid;
        }
        .items-table th, .items-table td {
            padding: 8px;
            text-align: left;
            border: 1px solid;
        }
        /* Total Section */
        .total-section {
            margin-top: 20px;
            text-align: right;
            margin-right: 20px;
            float: right;
            height: 200px;
            
        }
        /* Signature Section */
        .signature-table {
            width: 100%;
            margin-top: 200px;
        }
        .signature-table td {
            text-align: start;
            width: 50%;

            
        }
        /* Terms Section */
        .terms {
            margin-top: 30px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <table class="header-table">
            <tr>
                <td>
                     <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo.png'))) }}" alt="Logo">

                    <h4>Planetwork Technologies Pvt Ltd</h4>
                    <span>Company ID: U72200KA2006PTC040171</span><br>
                    <span>No 406 1st Floor 9th Main HRBR Layout 1st Block</span><br>
                    <span>Kalayan Nagar, Bangalore, Karnataka 560043, India</span><br>
                    <span>GSTIN: 29AACCN3614L1ZA</span><br>
                </td>
                <td style="text-align:right;">
                    <h2>INVOICE</h2>
                    <span><strong>Invoice Date:</strong> {{ date('d M Y', strtotime($quoteData['quote_date'])) }}</span><br>
                    <span><strong>Due Date:</strong> {{ date('d M Y', strtotime($quoteData['expiry_date'])) }}</span><br>
                    <span><strong>PO:</strong> {{ $quoteData['quote_number'] }}</span><br>
                </td>
            </tr>
        </table>

        <hr style="margin: 20px 0;" />

        <!-- Billing & Shipping Address -->
        <table class="address-table">
            <tr>
                <td>
                    <h3>Billing Address</h3>
                    <span>{{ $billingaddress->billing_address_line_1 }}</span><br>
                    <span>{{ $billingaddress->billing_address_line_2 }}</span><br>
                    <span>{{ $billingaddress->billing_city }}</span><br>
                    <span>{{ $billingaddress->billing_state }}</span><br>
                    <span>{{ $billingaddress->billing_pincode }}</span><br>
                </td>
                <td>
                    <h3>Shipping Address</h3>
                    <span>{{ $shippingaddress->shipping_address_line_1 }}</span><br>
                    <span>{{ $shippingaddress->shipping_address_line_2 }}</span><br>
                    <span>{{ $shippingaddress->shipping_city }}</span><br>
                    <span>{{ $shippingaddress->shipping_state }}</span><br>
                    <span>{{ $shippingaddress->shipping_pincode }}</span><br>
                </td>
            </tr>
        </table>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Item & Description</th>
                    <th>HSN/SAC</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>CGST</th>
                    <th>SGST</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quoteData->products as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->product_details->product_name }}</td>
                    <td>{{ $item->product_details->hsn_code }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->revised_price }}</td>
                    <td>{{ $item->product_details->gst }}%</td>
                    <td>{{ $item->product_details->igst }}%</td>
                    <td>{{ $item->amount }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total Section -->
        <div class="total-section">
            <table>
                <tr>
                    <td>Sub Total </td>
                    <td>: {{ $quoteData['sub_total'] }}</td>
                </tr>
                <tr>
                    <td>Discount </td>
                    <td>: {{ $quoteData['discount_percentage'] }}%</td>
                </tr>
                <tr>
                    <td>Discounted Amount </td>
                    <td>: {{ $quoteData['discount_amount'] }}</td>
                </tr>
                <tr>
                    <td>Adjustment </td>
                    <td>: {{ $quoteData['adjustment'] }}</td>
                </tr>
                <tr>
                    <td>Grand Total </td>
                    <td>: {{ $quoteData['grant_total'] }}</td>
                </tr>
                <tr>
                    <td>Balance Due </td>
                    <td>: {{ $quoteData['total'] }}</td>
                </tr>
            </table>
    </div>
        
        <!-- Signature Section -->
        <div>
        <table class="signature-table">

            <tr>
                <td><span>Payment on Receipt</span></td>
                <td><span>Authorized Signature: _______________</span></td>
            </tr>
        </table>
        </div>

        <!-- Terms & Conditions -->
        <div class="terms">
            <h3 style="background-color: #F5F5F5; padding: 8px;">Terms & Conditions</h3>
            <span>Funds transfer procedure in case of online payments:</span><br>
            <span>1. Invoice value in Indian rupees to be remitted to our current account number 029805001132 with ICICI Bank Ltd. Kammanahalli Branch, Bangalore – 560 084, Karnataka, India.</span><br>
            <span>2. Invoice value in US Dollars to be remitted to our current account number 029805001132 with ICICI Bank Ltd. Kammanahalli Branch, Bangalore– 560 084 IFS Code-ICIC0000298, Karnataka, India.</span><br>
            <span>3. Pay to: JP Morgan Chase Bank New York (SWIFT: CHASUS33XXX) for payment to ICICI Bank Ltd. (SWIFT:ICICINBB) for final CREDIT TO ACCOUNT No: 029805001132 of NETIAPPS SOFTWARE PVT LTD. WITH ICICI BANK LTD, HRBR Layout, Kammanahalli, Bangalore-560084</span><br>
        </div>
    </div>
</body>
</html>
