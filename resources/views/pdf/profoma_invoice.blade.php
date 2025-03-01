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
           
            margin: 50px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header img {
            max-width: 150px;
        }
        .billing, .shipping {
            width: 50%;
            display: inline-block;
            vertical-align: top;
        }
        .address {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
            margin-bottom: 30px;
        }
        .signature {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 100px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .total-section {
            margin-top: 20px;
            text-align: right;
        }
        .terms {
            margin-top: 30px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <img src="/images/planetwork_logo.svg">
                <h4>Planetwork Technologies Pvt Ltd</h4>
                <span>Company ID : U72200KA2006PTC040171</span><br>
                <span>No 406 1st Floor 9th Main HRBR Layout 1st Block</span><br>
                <span>Kalayan Nagar</span><br>
                <span>Bangalore Karnataka 560043</span><br>
                <span>India</span><br>
                <span>GSTIN 29AACCN3614L1ZA</span>
                
            </div>
           
            <div >
                <h2>INVOICE</h2>
                <p><strong>Invoice Date:</strong> {{ date('d M Y'),strtotime($quoteData['quote_date']) }}</p>
                <p><strong>Due Date:</strong> {{ date('d M Y'),strtotime($quoteData['expiry_date']) }}</p>
                <p><strong>PO:</strong> {{ $quoteData['quote_number'] }}</p>
            </div>
        </div>

        <hr style="margin: 20px 0px 20px 0px;" />

        <div class="address">
            <div class="billing">
                <h3>Billing Address</h3>
                <span>{{ $billingaddress->billing_address_line_1 }}</span><br>
                <span>{{ $billingaddress->billing_address_line_2 }}</span><br>
                <span>{{ $billingaddress->billing_city }}</span><br>
                <span>{{ $billingaddress->billing_state }}</span><br>
                <span>{{ $billingaddress->billing_pincode }}</span>
            </div>
           
            <div class="shipping">
                <h3>Shipping Address</h3>
                <span>{{ $shippingaddress->shipping_address_line_1 }}</span><br>
                <span>{{ $shippingaddress->shipping_address_line_2 }}</span><br>
                <span>{{ $shippingaddress->shipping_city }}</span><br>
                <span>{{ $shippingaddress->shipping_state }}</span><br>
                <span>{{ $shippingaddress->shipping_pincode }}</span>
            </div>
        </div>

        <table>
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

        <div class="total-section">
            <p><strong>Sub Total :</strong> {{ $quoteData['sub_total'] }}</p>
            <p><strong>Discount  :</strong> {{ $quoteData['discount_percentage'] }}%</p>
            <p><strong>Discounted Amount:</strong> {{ $quoteData['discount_amount'] }}</p>
            <p><strong>Adjustment :</strong> {{ $quoteData['adjustment'] }}</p>
            <p><strong>Grand Total :</strong> {{ $quoteData['grant_total'] }}</p>
            <p><strong>Balance Due:</strong> {{ $quoteData['total'] }}</p>
        </div>
        
        <div class="signature">
        <p>Payment on Receipt</p>
        <p>Authorized Signature: _______________</p>
        </div>
        

        <div class="terms">
            <h3 style="background-color: #F5F5F5;padding: 8px;">Terms & Conditions</h3>
            <p>Funds transfer procedure in case of online payments:</p>
            <p>1. Invoice value in Indian rupees to be remitted to our current account number 029805001132 with ICICI Bank Ltd. Kammanahalli Branch, Bangalore – 560 084, Karnataka, India.</p>
            <p>2. Invoice value in US Dollars to be remitted to our current account number 029805001132 with ICICI Bank Ltd. Kammanahalli Branch, Bangalore– 560 084 IFS Code-ICIC0000298, Karnataka, India.</p>
            <p>3.  Pay to: JP Morgan chase bank New York (SWIFT: CHASUS33XXX) for payment to ICICI Bank Ltd. (SWIFT:ICICINBB) for final CREDIT TO ACCOUNT No: 029805001132 of NETIAPPS SOFTWARE PVT LTD. WITH ICICI BANK LTD, HRBR Layout, Kammanahalli, Bangalore-560084</p>
        </div>
    </div>
</body>
</html>
