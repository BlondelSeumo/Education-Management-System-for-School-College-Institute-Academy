<script src="{{asset('public/backEnd/')}}/js/main.js"></script>
<div class="container-fluid">
    <div class="row mb-20">
        <div class="col-lg-4">
            <div class="invoice-details-left">
                <div class="mb-20">
                    <label for="companyLogo" class="company-logo">
                        <i class="ti-image"></i> Company Logo
                    </label>
                    <input id="companyLogo" type="file"/>
                </div>

                <div class="business-info">
                    <h3>Google inc.</h3>
                    <p>Mohamed Salah Qayser</p>
                    <p>163, Golf green road, Rocky beach</p>
                    <p>Los angeles, United States</p>
                    <p>myemail@mycompany.com</p>
                </div>
            </div>
        </div>

        <div class="offset-lg-4 col-lg-4">
            <div class="invoice-details-right">
                <h1 class="text-uppercase">invoice</h1>

                <div class="d-flex justify-content-between">
                    <p class="fw-500 primary-color">Invoice Number#:</p>
                    <p>0001</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="fw-500 primary-color">Invoice Data:</p>
                    <p>07/07/2018</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="fw-500 primary-color">Reference::</p>
                    <p>#698536</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="fw-500 primary-color">Due Date:</p>
                    <p>07/07/2018</p>
                </div>

                <span class="primary-btn fix-gr-bg large mt-30">$2052.00</span>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-lg-12">
            <div class="customer-info">
                <h2>Bill To:</h2>
            </div>

            <div class="client-info">
                <h3>Google inc.</h3>
                <p>Mohamed Salah Qayser</p>
                <p>163, Golf green road, Rocky beach</p>
                <p>Los angeles, United States</p>
                <p>myemail@mycompany.com</p>
            </div>
        </div>
    </div>

    <hr>

    <div class="row mt-30 mb-50">
        <div class="col-lg-12">
            <table class="d-table table-responsive custom-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="40%">Description</th>
                        <th width="20%">Quantity</th>
                        <th width="20%">Price</th>
                        <th width="20%">Amount</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Item 01</td>
                        <td>03</td>
                        <td>60.00</td>
                        <td>180.00</td>
                    </tr>
                    <tr>
                        <td>Item 01</td>
                        <td>03</td>
                        <td>60.00</td>
                        <td>180.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="fw-600 primary-color">Subtotal</td>
                        <td>2400.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="fw-600 primary-color">Discount <span>(10%)</span> </td>
                        <td> <span>(-)</span> 240.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="fw-600 primary-color">Shipping</td>
                        <td>10.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="fw-600 primary-color">GST <span>(5%)</span> </td>
                        <td>108.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="fw-600 text-dark">Total</td>
                        <td class="fw-600 text-dark">2052.00</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
        