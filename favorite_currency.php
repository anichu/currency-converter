<?php  
require "./header.php"
?>




<!-- Update Books Modal -->
<div class="modal fade" id="updateFavoriteCurrencyModal" tabindex="-1" aria-labelledby="updateFavoriteCurrencyModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateFavoriteCurrencyModalLabel">Update book</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body w-full">
        <!-- Update User Form -->
        <form  id="updateCurrencyForm">
          <input type="hidden" id="updateCurrencyId">
          <div class="form-group">
            <label for="updateFromCurrency">FromCurrency: </label>
            <select class="form-control form-control-sm" id="updateFromCurrency">
              <option value="AED">AED</option>
              <option value="AFN">AFN</option>
              <option value="ALL">ALL</option>
              <option value="AMD">AMD</option>
              <option value="ANG">ANG</option>
              <option value="AOA">AOA</option>
              <option value="ARS">ARS</option>
              <option value="AUD">AUD</option>
              <option value="AWG">AWG</option>
              <option value="AZN">AZN</option>
              <option value="BAM">BAM</option>
              <option value="BBD">BBD</option>
              <option value="BDT">BDT</option>
              <option value="BGN">BGN</option>
              <option value="BHD">BHD</option>
              <option value="BIF">BIF</option>
              <option value="BMD">BMD</option>
              <option value="BND">BND</option>
              <option value="BOB">BOB</option>
              <option value="BRL">BRL</option>
              <option value="BSD">BSD</option>
              <option value="BTC">BTC</option>
              <option value="BTN">BTN</option>
              <option value="BWP">BWP</option>
              <option value="BYN">BYN</option>
              <option value="BZD">BZD</option>
              <option value="CAD">CAD</option>
              <option value="CDF">CDF</option>
              <option value="CHF">CHF</option>
              <option value="CLF">CLF</option>
              <option value="CLP">CLP</option>
              <option value="CNH">CNH</option>
              <option value="CNY">CNY</option>
              <option value="COP">COP</option>
              <option value="CRC">CRC</option>
              <option value="CUC">CUC</option>
              <option value="CUP">CUP</option>
              <option value="CVE">CVE</option>
              <option value="CZK">CZK</option>
              <option value="DJF">DJF</option>
              <option value="DKK">DKK</option>
              <option value="DOP">DOP</option>
              <option value="DZD">DZD</option>
              <option value="EGP">EGP</option>
              <option value="ERN">ERN</option>
              <option value="ETB">ETB</option>
              <option value="EUR">EUR</option>
              <option value="FJD">FJD</option>
              <option value="FKP">FKP</option>
              <option value="GBP">GBP</option>
              <option value="GEL">GEL</option>
              <option value="GGP">GGP</option>
              <option value="GHS">GHS</option>
              <option value="GIP">GIP</option>
              <option value="GMD">GMD</option>
              <option value="GNF">GNF</option>
              <option value="GTQ">GTQ</option>
              <option value="GYD">GYD</option>
              <option value="HKD">HKD</option>
              <option value="HNL">HNL</option>
              <option value="HRK">HRK</option>
              <option value="HTG">HTG</option>
              <option value="HUF">HUF</option>
              <option value="IDR">IDR</option>
              <option value="ILS">ILS</option>
              <option value="IMP">IMP</option>
              <option value="INR">INR</option>
              <option value="IQD">IQD</option>
              <option value="IRR">IRR</option>
              <option value="ISK">ISK</option>
              <option value="JEP">JEP</option>
              <option value="JMD">JMD</option>
              <option value="JOD">JOD</option>
              <option value="JPY">JPY</option>
              <option value="KES">KES</option>
              <option value="KGS">KGS</option>
              <option value="KHR">KHR</option>
              <option value="KMF">KMF</option>
              <option value="KPW">KPW</option>
              <option value="KRW">KRW</option>
              <option value="KWD">KWD</option>
              <option value="KYD">KYD</option>
              <option value="KZT">KZT</option>
              <option value="LAK">LAK</option>
              <option value="LBP">LBP</option>
              <option value="LKR">LKR</option>
              <option value="LRD">LRD</option>
              <option value="LSL">LSL</option>
              <option value="LYD">LYD</option>
              <option value="MAD">MAD</option>
              <option value="MDL">MDL</option>
              <option value="MGA">MGA</option>
              <option value="MKD">MKD</option>
              <option value="MMK">MMK</option>
              <option value="MNT">MNT</option>
              <option value="MOP">MOP</option>
              <option value="MRU">MRU</option>
              <option value="MUR">MUR</option>
              <option value="MVR">MVR</option>
              <option value="MWK">MWK</option>
              <option value="MXN">MXN</option>
              <option value="MYR">MYR</option>
              <option value="MZN">MZN</option>
              <option value="NAD">NAD</option>
              <option value="NGN">NGN</option>
              <option value="NIO">NIO</option>
              <option value="NOK">NOK</option>
              <option value="NPR">NPR</option>
              <option value="NZD">NZD</option>
              <option value="OMR">OMR</option>
              <option value="PAB">PAB</option>
              <option value="PEN">PEN</option>
              <option value="PGK">PGK</option>
              <option value="PHP">PHP</option>
              <option value="PKR">PKR</option>
              <option value="PLN">PLN</option>
              <option value="PYG">PYG</option>
              <option value="QAR">QAR</option>
              <option value="RON">RON</option>
              <option value="RSD">RSD</option>
              <option value="RUB">RUB</option>
              <option value="RWF">RWF</option>
              <option value="SAR">SAR</option>
              <option value="SBD">SBD</option>
              <option value="SCR">SCR</option>
              <option value="SDG">SDG</option>
              <option value="SEK">SEK</option>
              <option value="SGD">SGD</option>
              <option value="SHP">SHP</option>
              <option value="SLL">SLL</option>
              <option value="SOS">SOS</option>
              <option value="SRD">SRD</option>
              <option value="SSP">SSP</option>
              <option value="STN">STN</option>
              <option value="SVC">SVC</option>
              <option value="SYP">SYP</option>
              <option value="SZL">SZL</option>
              <option value="THB">THB</option>
              <option value="TJS">TJS</option>
              <option value="TMT">TMT</option>
              <option value="TND">TND</option>
              <option value="TOP">TOP</option>
              <option value="TRY">TRY</option>
              <option value="TTD">TTD</option>
              <option value="TWD">TWD</option>
              <option value="TZS">TZS</option>
              <option value="UAH">UAH</option>
              <option value="UGX">UGX</option>
              <option value="USD">USD</option>
              <option value="UYU">UYU</option>
              <option value="UZS">UZS</option>
              <option value="VES">VES</option>
              <option value="VND">VND</option>
              <option value="VUV">VUV</option>
              <option value="WST">WST</option>
              <option value="XAF">XAF</option>
              <option value="XAG">XAG</option>
              <option value="XAU">XAU</option>
              <option value="XCD">XCD</option>
              <option value="XDR">XDR</option>
              <option value="XOF">XOF</option>
              <option value="XPD">XPD</option>
              <option value="XPF">XPF</option>
              <option value="XPT">XPT</option>
              <option value="YER">YER</option>
              <option value="ZAR">ZAR</option>
              <option value="ZMW">ZMW</option>
              <option value="ZWL">ZWL</option>
              <!-- Add more currency options as needed -->
            </select>
          </div>

          <div class="form-group">
            <label for="updateToCurrency">ToCurrency: </label>
            <select class="form-control form-control-sm" id="updateToCurrency">
              <option value="AED">AED</option>
              <option value="AFN">AFN</option>
              <option value="ALL">ALL</option>
              <option value="AMD">AMD</option>
              <option value="ANG">ANG</option>
              <option value="AOA">AOA</option>
              <option value="ARS">ARS</option>
              <option value="AUD">AUD</option>
              <option value="AWG">AWG</option>
              <option value="AZN">AZN</option>
              <option value="BAM">BAM</option>
              <option value="BBD">BBD</option>
              <option value="BDT">BDT</option>
              <option value="BGN">BGN</option>
              <option value="BHD">BHD</option>
              <option value="BIF">BIF</option>
              <option value="BMD">BMD</option>
              <option value="BND">BND</option>
              <option value="BOB">BOB</option>
              <option value="BRL">BRL</option>
              <option value="BSD">BSD</option>
              <option value="BTC">BTC</option>
              <option value="BTN">BTN</option>
              <option value="BWP">BWP</option>
              <option value="BYN">BYN</option>
              <option value="BZD">BZD</option>
              <option value="CAD">CAD</option>
              <option value="CDF">CDF</option>
              <option value="CHF">CHF</option>
              <option value="CLF">CLF</option>
              <option value="CLP">CLP</option>
              <option value="CNH">CNH</option>
              <option value="CNY">CNY</option>
              <option value="COP">COP</option>
              <option value="CRC">CRC</option>
              <option value="CUC">CUC</option>
              <option value="CUP">CUP</option>
              <option value="CVE">CVE</option>
              <option value="CZK">CZK</option>
              <option value="DJF">DJF</option>
              <option value="DKK">DKK</option>
              <option value="DOP">DOP</option>
              <option value="DZD">DZD</option>
              <option value="EGP">EGP</option>
              <option value="ERN">ERN</option>
              <option value="ETB">ETB</option>
              <option value="EUR">EUR</option>
              <option value="FJD">FJD</option>
              <option value="FKP">FKP</option>
              <option value="GBP">GBP</option>
              <option value="GEL">GEL</option>
              <option value="GGP">GGP</option>
              <option value="GHS">GHS</option>
              <option value="GIP">GIP</option>
              <option value="GMD">GMD</option>
              <option value="GNF">GNF</option>
              <option value="GTQ">GTQ</option>
              <option value="GYD">GYD</option>
              <option value="HKD">HKD</option>
              <option value="HNL">HNL</option>
              <option value="HRK">HRK</option>
              <option value="HTG">HTG</option>
              <option value="HUF">HUF</option>
              <option value="IDR">IDR</option>
              <option value="ILS">ILS</option>
              <option value="IMP">IMP</option>
              <option value="INR">INR</option>
              <option value="IQD">IQD</option>
              <option value="IRR">IRR</option>
              <option value="ISK">ISK</option>
              <option value="JEP">JEP</option>
              <option value="JMD">JMD</option>
              <option value="JOD">JOD</option>
              <option value="JPY">JPY</option>
              <option value="KES">KES</option>
              <option value="KGS">KGS</option>
              <option value="KHR">KHR</option>
              <option value="KMF">KMF</option>
              <option value="KPW">KPW</option>
              <option value="KRW">KRW</option>
              <option value="KWD">KWD</option>
              <option value="KYD">KYD</option>
              <option value="KZT">KZT</option>
              <option value="LAK">LAK</option>
              <option value="LBP">LBP</option>
              <option value="LKR">LKR</option>
              <option value="LRD">LRD</option>
              <option value="LSL">LSL</option>
              <option value="LYD">LYD</option>
              <option value="MAD">MAD</option>
              <option value="MDL">MDL</option>
              <option value="MGA">MGA</option>
              <option value="MKD">MKD</option>
              <option value="MMK">MMK</option>
              <option value="MNT">MNT</option>
              <option value="MOP">MOP</option>
              <option value="MRU">MRU</option>
              <option value="MUR">MUR</option>
              <option value="MVR">MVR</option>
              <option value="MWK">MWK</option>
              <option value="MXN">MXN</option>
              <option value="MYR">MYR</option>
              <option value="MZN">MZN</option>
              <option value="NAD">NAD</option>
              <option value="NGN">NGN</option>
              <option value="NIO">NIO</option>
              <option value="NOK">NOK</option>
              <option value="NPR">NPR</option>
              <option value="NZD">NZD</option>
              <option value="OMR">OMR</option>
              <option value="PAB">PAB</option>
              <option value="PEN">PEN</option>
              <option value="PGK">PGK</option>
              <option value="PHP">PHP</option>
              <option value="PKR">PKR</option>
              <option value="PLN">PLN</option>
              <option value="PYG">PYG</option>
              <option value="QAR">QAR</option>
              <option value="RON">RON</option>
              <option value="RSD">RSD</option>
              <option value="RUB">RUB</option>
              <option value="RWF">RWF</option>
              <option value="SAR">SAR</option>
              <option value="SBD">SBD</option>
              <option value="SCR">SCR</option>
              <option value="SDG">SDG</option>
              <option value="SEK">SEK</option>
              <option value="SGD">SGD</option>
              <option value="SHP">SHP</option>
              <option value="SLL">SLL</option>
              <option value="SOS">SOS</option>
              <option value="SRD">SRD</option>
              <option value="SSP">SSP</option>
              <option value="STN">STN</option>
              <option value="SVC">SVC</option>
              <option value="SYP">SYP</option>
              <option value="SZL">SZL</option>
              <option value="THB">THB</option>
              <option value="TJS">TJS</option>
              <option value="TMT">TMT</option>
              <option value="TND">TND</option>
              <option value="TOP">TOP</option>
              <option value="TRY">TRY</option>
              <option value="TTD">TTD</option>
              <option value="TWD">TWD</option>
              <option value="TZS">TZS</option>
              <option value="UAH">UAH</option>
              <option value="UGX">UGX</option>
              <option value="USD">USD</option>
              <option value="UYU">UYU</option>
              <option value="UZS">UZS</option>
              <option value="VES">VES</option>
              <option value="VND">VND</option>
              <option value="VUV">VUV</option>
              <option value="WST">WST</option>
              <option value="XAF">XAF</option>
              <option value="XAG">XAG</option>
              <option value="XAU">XAU</option>
              <option value="XCD">XCD</option>
              <option value="XDR">XDR</option>
              <option value="XOF">XOF</option>
              <option value="XPD">XPD</option>
              <option value="XPF">XPF</option>
              <option value="XPT">XPT</option>
              <option value="YER">YER</option>
              <option value="ZAR">ZAR</option>
              <option value="ZMW">ZMW</option>
              <option value="ZWL">ZWL</option>
              <!-- Add more currency options as needed -->
            </select>
          </div>        

          <button type="submit" data-bs-target="#updateFavoriteCurrencyModal" data-bs-dismiss="modal" class="btn btn-primary mt-2">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div id="successMessage" class="alert alert-success mt-3 d-none" role="alert">
  Favorite currency created successfully
</div>

<div id="errorMessage" class="alert alert-danger mt-3 d-none" role="alert">
  An error occurred. Please try again later.
</div>

<form action="" id="submitForm" class="d-flex justify-content-around w-full my-5" method="post">
  <!-- From currency -->
  <div class="form-group me-2  align-items-center w-50 d-flex">
    <label for="fromCurrency">FromCurrency: </label>
    <select class="form-control form-control-sm" id="fromCurrency">
      <option value="AED">AED</option>
      <option value="AFN">AFN</option>
      <option value="ALL">ALL</option>
      <option value="AMD">AMD</option>
      <option value="ANG">ANG</option>
      <option value="AOA">AOA</option>
      <option value="ARS">ARS</option>
      <option value="AUD">AUD</option>
      <option value="AWG">AWG</option>
      <option value="AZN">AZN</option>
      <option value="BAM">BAM</option>
      <option value="BBD">BBD</option>
      <option value="BDT">BDT</option>
      <option value="BGN">BGN</option>
      <option value="BHD">BHD</option>
      <option value="BIF">BIF</option>
      <option value="BMD">BMD</option>
      <option value="BND">BND</option>
      <option value="BOB">BOB</option>
      <option value="BRL">BRL</option>
      <option value="BSD">BSD</option>
      <option value="BTC">BTC</option>
      <option value="BTN">BTN</option>
      <option value="BWP">BWP</option>
      <option value="BYN">BYN</option>
      <option value="BZD">BZD</option>
      <option value="CAD">CAD</option>
      <option value="CDF">CDF</option>
      <option value="CHF">CHF</option>
      <option value="CLF">CLF</option>
      <option value="CLP">CLP</option>
      <option value="CNH">CNH</option>
      <option value="CNY">CNY</option>
      <option value="COP">COP</option>
      <option value="CRC">CRC</option>
      <option value="CUC">CUC</option>
      <option value="CUP">CUP</option>
      <option value="CVE">CVE</option>
      <option value="CZK">CZK</option>
      <option value="DJF">DJF</option>
      <option value="DKK">DKK</option>
      <option value="DOP">DOP</option>
      <option value="DZD">DZD</option>
      <option value="EGP">EGP</option>
      <option value="ERN">ERN</option>
      <option value="ETB">ETB</option>
      <option value="EUR">EUR</option>
      <option value="FJD">FJD</option>
      <option value="FKP">FKP</option>
      <option value="GBP">GBP</option>
      <option value="GEL">GEL</option>
      <option value="GGP">GGP</option>
      <option value="GHS">GHS</option>
      <option value="GIP">GIP</option>
      <option value="GMD">GMD</option>
      <option value="GNF">GNF</option>
      <option value="GTQ">GTQ</option>
      <option value="GYD">GYD</option>
      <option value="HKD">HKD</option>
      <option value="HNL">HNL</option>
      <option value="HRK">HRK</option>
      <option value="HTG">HTG</option>
      <option value="HUF">HUF</option>
      <option value="IDR">IDR</option>
      <option value="ILS">ILS</option>
      <option value="IMP">IMP</option>
      <option value="INR">INR</option>
      <option value="IQD">IQD</option>
      <option value="IRR">IRR</option>
      <option value="ISK">ISK</option>
      <option value="JEP">JEP</option>
      <option value="JMD">JMD</option>
      <option value="JOD">JOD</option>
      <option value="JPY">JPY</option>
      <option value="KES">KES</option>
      <option value="KGS">KGS</option>
      <option value="KHR">KHR</option>
      <option value="KMF">KMF</option>
      <option value="KPW">KPW</option>
      <option value="KRW">KRW</option>
      <option value="KWD">KWD</option>
      <option value="KYD">KYD</option>
      <option value="KZT">KZT</option>
      <option value="LAK">LAK</option>
      <option value="LBP">LBP</option>
      <option value="LKR">LKR</option>
      <option value="LRD">LRD</option>
      <option value="LSL">LSL</option>
      <option value="LYD">LYD</option>
      <option value="MAD">MAD</option>
      <option value="MDL">MDL</option>
      <option value="MGA">MGA</option>
      <option value="MKD">MKD</option>
      <option value="MMK">MMK</option>
      <option value="MNT">MNT</option>
      <option value="MOP">MOP</option>
      <option value="MRU">MRU</option>
      <option value="MUR">MUR</option>
      <option value="MVR">MVR</option>
      <option value="MWK">MWK</option>
      <option value="MXN">MXN</option>
      <option value="MYR">MYR</option>
      <option value="MZN">MZN</option>
      <option value="NAD">NAD</option>
      <option value="NGN">NGN</option>
      <option value="NIO">NIO</option>
      <option value="NOK">NOK</option>
      <option value="NPR">NPR</option>
      <option value="NZD">NZD</option>
      <option value="OMR">OMR</option>
      <option value="PAB">PAB</option>
      <option value="PEN">PEN</option>
      <option value="PGK">PGK</option>
      <option value="PHP">PHP</option>
      <option value="PKR">PKR</option>
      <option value="PLN">PLN</option>
      <option value="PYG">PYG</option>
      <option value="QAR">QAR</option>
      <option value="RON">RON</option>
      <option value="RSD">RSD</option>
      <option value="RUB">RUB</option>
      <option value="RWF">RWF</option>
      <option value="SAR">SAR</option>
      <option value="SBD">SBD</option>
      <option value="SCR">SCR</option>
      <option value="SDG">SDG</option>
      <option value="SEK">SEK</option>
      <option value="SGD">SGD</option>
      <option value="SHP">SHP</option>
      <option value="SLL">SLL</option>
      <option value="SOS">SOS</option>
      <option value="SRD">SRD</option>
      <option value="SSP">SSP</option>
      <option value="STN">STN</option>
      <option value="SVC">SVC</option>
      <option value="SYP">SYP</option>
      <option value="SZL">SZL</option>
      <option value="THB">THB</option>
      <option value="TJS">TJS</option>
      <option value="TMT">TMT</option>
      <option value="TND">TND</option>
      <option value="TOP">TOP</option>
      <option value="TRY">TRY</option>
      <option value="TTD">TTD</option>
      <option value="TWD">TWD</option>
      <option value="TZS">TZS</option>
      <option value="UAH">UAH</option>
      <option value="UGX">UGX</option>
      <option value="USD">USD</option>
      <option value="UYU">UYU</option>
      <option value="UZS">UZS</option>
      <option value="VES">VES</option>
      <option value="VND">VND</option>
      <option value="VUV">VUV</option>
      <option value="WST">WST</option>
      <option value="XAF">XAF</option>
      <option value="XAG">XAG</option>
      <option value="XAU">XAU</option>
      <option value="XCD">XCD</option>
      <option value="XDR">XDR</option>
      <option value="XOF">XOF</option>
      <option value="XPD">XPD</option>
      <option value="XPF">XPF</option>
      <option value="XPT">XPT</option>
      <option value="YER">YER</option>
      <option value="ZAR">ZAR</option>
      <option value="ZMW">ZMW</option>
      <option value="ZWL">ZWL</option>
      <!-- Add more currency options as needed -->
    </select>
  </div>
  <!-- To Currency Dropdown -->
  <div class="form-group  align-items-center w-50  d-flex">
    <label for="toCurrency">ToCurrency: </label>
    <select class="form-control form-control-sm" id="toCurrency">
      <option value="AED">AED</option>
      <option value="AFN">AFN</option>
      <option value="ALL">ALL</option>
      <option value="AMD">AMD</option>
      <option value="ANG">ANG</option>
      <option value="AOA">AOA</option>
      <option value="ARS">ARS</option>
      <option value="AUD">AUD</option>
      <option value="AWG">AWG</option>
      <option value="AZN">AZN</option>
      <option value="BAM">BAM</option>
      <option value="BBD">BBD</option>
      <option value="BDT">BDT</option>
      <option value="BGN">BGN</option>
      <option value="BHD">BHD</option>
      <option value="BIF">BIF</option>
      <option value="BMD">BMD</option>
      <option value="BND">BND</option>
      <option value="BOB">BOB</option>
      <option value="BRL">BRL</option>
      <option value="BSD">BSD</option>
      <option value="BTC">BTC</option>
      <option value="BTN">BTN</option>
      <option value="BWP">BWP</option>
      <option value="BYN">BYN</option>
      <option value="BZD">BZD</option>
      <option value="CAD">CAD</option>
      <option value="CDF">CDF</option>
      <option value="CHF">CHF</option>
      <option value="CLF">CLF</option>
      <option value="CLP">CLP</option>
      <option value="CNH">CNH</option>
      <option value="CNY">CNY</option>
      <option value="COP">COP</option>
      <option value="CRC">CRC</option>
      <option value="CUC">CUC</option>
      <option value="CUP">CUP</option>
      <option value="CVE">CVE</option>
      <option value="CZK">CZK</option>
      <option value="DJF">DJF</option>
      <option value="DKK">DKK</option>
      <option value="DOP">DOP</option>
      <option value="DZD">DZD</option>
      <option value="EGP">EGP</option>
      <option value="ERN">ERN</option>
      <option value="ETB">ETB</option>
      <option value="EUR">EUR</option>
      <option value="FJD">FJD</option>
      <option value="FKP">FKP</option>
      <option value="GBP">GBP</option>
      <option value="GEL">GEL</option>
      <option value="GGP">GGP</option>
      <option value="GHS">GHS</option>
      <option value="GIP">GIP</option>
      <option value="GMD">GMD</option>
      <option value="GNF">GNF</option>
      <option value="GTQ">GTQ</option>
      <option value="GYD">GYD</option>
      <option value="HKD">HKD</option>
      <option value="HNL">HNL</option>
      <option value="HRK">HRK</option>
      <option value="HTG">HTG</option>
      <option value="HUF">HUF</option>
      <option value="IDR">IDR</option>
      <option value="ILS">ILS</option>
      <option value="IMP">IMP</option>
      <option value="INR">INR</option>
      <option value="IQD">IQD</option>
      <option value="IRR">IRR</option>
      <option value="ISK">ISK</option>
      <option value="JEP">JEP</option>
      <option value="JMD">JMD</option>
      <option value="JOD">JOD</option>
      <option value="JPY">JPY</option>
      <option value="KES">KES</option>
      <option value="KGS">KGS</option>
      <option value="KHR">KHR</option>
      <option value="KMF">KMF</option>
      <option value="KPW">KPW</option>
      <option value="KRW">KRW</option>
      <option value="KWD">KWD</option>
      <option value="KYD">KYD</option>
      <option value="KZT">KZT</option>
      <option value="LAK">LAK</option>
      <option value="LBP">LBP</option>
      <option value="LKR">LKR</option>
      <option value="LRD">LRD</option>
      <option value="LSL">LSL</option>
      <option value="LYD">LYD</option>
      <option value="MAD">MAD</option>
      <option value="MDL">MDL</option>
      <option value="MGA">MGA</option>
      <option value="MKD">MKD</option>
      <option value="MMK">MMK</option>
      <option value="MNT">MNT</option>
      <option value="MOP">MOP</option>
      <option value="MRU">MRU</option>
      <option value="MUR">MUR</option>
      <option value="MVR">MVR</option>
      <option value="MWK">MWK</option>
      <option value="MXN">MXN</option>
      <option value="MYR">MYR</option>
      <option value="MZN">MZN</option>
      <option value="NAD">NAD</option>
      <option value="NGN">NGN</option>
      <option value="NIO">NIO</option>
      <option value="NOK">NOK</option>
      <option value="NPR">NPR</option>
      <option value="NZD">NZD</option>
      <option value="OMR">OMR</option>
      <option value="PAB">PAB</option>
      <option value="PEN">PEN</option>
      <option value="PGK">PGK</option>
      <option value="PHP">PHP</option>
      <option value="PKR">PKR</option>
      <option value="PLN">PLN</option>
      <option value="PYG">PYG</option>
      <option value="QAR">QAR</option>
      <option value="RON">RON</option>
      <option value="RSD">RSD</option>
      <option value="RUB">RUB</option>
      <option value="RWF">RWF</option>
      <option value="SAR">SAR</option>
      <option value="SBD">SBD</option>
      <option value="SCR">SCR</option>
      <option value="SDG">SDG</option>
      <option value="SEK">SEK</option>
      <option value="SGD">SGD</option>
      <option value="SHP">SHP</option>
      <option value="SLL">SLL</option>
      <option value="SOS">SOS</option>
      <option value="SRD">SRD</option>
      <option value="SSP">SSP</option>
      <option value="STN">STN</option>
      <option value="SVC">SVC</option>
      <option value="SYP">SYP</option>
      <option value="SZL">SZL</option>
      <option value="THB">THB</option>
      <option value="TJS">TJS</option>
      <option value="TMT">TMT</option>
      <option value="TND">TND</option>
      <option value="TOP">TOP</option>
      <option value="TRY">TRY</option>
      <option value="TTD">TTD</option>
      <option value="TWD">TWD</option>
      <option value="TZS">TZS</option>
      <option value="UAH">UAH</option>
      <option value="UGX">UGX</option>
      <option value="USD">USD</option>
      <option value="UYU">UYU</option>
      <option value="UZS">UZS</option>
      <option value="VES">VES</option>
      <option value="VND">VND</option>
      <option value="VUV">VUV</option>
      <option value="WST">WST</option>
      <option value="XAF">XAF</option>
      <option value="XAG">XAG</option>
      <option value="XAU">XAU</option>
      <option value="XCD">XCD</option>
      <option value="XDR">XDR</option>
      <option value="XOF">XOF</option>
      <option value="XPD">XPD</option>
      <option value="XPF">XPF</option>
      <option value="XPT">XPT</option>
      <option value="YER">YER</option>
      <option value="ZAR">ZAR</option>
      <option value="ZMW">ZMW</option>
      <option value="ZWL">ZWL</option>
      <!-- Add more currency options as needed -->
    </select>
  </div>
  <div class="w-25 ms-2">
    <button type="submit" class="btn btn-primary btn-sm w-100">Add favorite currency</button>
  </div>
</form>

<table class="table">
    <thead class="text-center">
      <tr>
        <th>ID</th>
        <th>FROM CURRENCY</th>
        <th>TO CURRENCY</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody id="tableBody">
      
    </tbody>
  </table>
</div>


<script>

  function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }
  const userData = JSON.parse(getCookie('crud-user'));

  const fetchUser = async ()=>{
    const data = await fetch('http://localhost/rahat/api/verify-jwt',{
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        token: userData?.token
      })
    })

    return data;
    
  }

  
  //TODO:: show student information
  const showFavoriteCurrencies = () => {
    fetchUser().then(res=>res.json()).then(data=>{
      var xhr = new XMLHttpRequest();
      xhr.open('GET', `http://localhost/rahat/api/favorite_currencies/favorite_currencies/all/${data?.email}`, true);
      var results = [];
      document.getElementById('tableBody').innerHTML = `
      <tr>
        <td colspan="7" class="text-center">
          <div class="spinner-border" role="status">
            <span class="visually-hidden"></span>
          </div>
        </td>
      </tr>
      `;

      xhr.onload = function () {
        if (this.status == 200) {
          currencies = JSON.parse(this.responseText);
          var tableRows = '';

          currencies.forEach(function (currency) {

            tableRows += `
            <tr class="text-black-100 text-xl">
              <td class="border border-slate">${currency.id}</td>
              <td class="border border-slate">${currency.fromCurrency}</td>
              <td class="border border-slate">${currency.toCurrency}</td>
              <td>
                <button class='btn btn-primary btn-sm' onclick='deleteFavoriteCurrencies(${currency.id})' id="deleteBtn">Delete</button>
              </td>
              <td>
                <button onclick='editFavoriteCurrencies(${currency.id})' class='btn btn-danger btn-sm'>Edit</button>
              </td>
            </tr>

            `;
          });

          document.getElementById('tableBody').innerHTML = tableRows;
        }
      };
      xhr.send();
    }).catch(error=>{
      console.error('Error:', error);
    })
  };
  
  //TODO:: Call the showFavoriteCurrencies function to fetch and display the user data
  showFavoriteCurrencies();

  const submitForm = document.getElementById("submitForm");
  submitForm.addEventListener("submit", function(event){
    event.preventDefault();
    console.log("submit");

    const toCurrency = document.getElementById("toCurrency").value;
    const fromCurrency = document.getElementById("fromCurrency").value;

    
      fetchUser().then(res=>res.json()).then(data=>{

        // Create an object to hold the form data
        const formData = {
          toCurrency: toCurrency,
          fromCurrency: fromCurrency,
          email: data?.email,
        };
        // Create a new XMLHttpRequest object
        const xhr = new XMLHttpRequest();
        // Set the request URL and method
          xhr.open("POST", "http://localhost/rahat/api/favorite_currencies/favorite_currencies/", true);

        // Set the request header
          xhr.setRequestHeader("Content-Type", "application/json");

        // Define the callback function to handle the response
          xhr.onload = function() {
          if (xhr.status >= 200 && xhr.status < 400) {
            // Request was successful
            const response = JSON.parse(xhr.responseText);
            console.log(response);
            // Handle the response data
            // For example, display a success message to the user
            // alert("Favorite currency created successfully");
            document.getElementById("successMessage").classList.remove("d-none");
            document.getElementById("errorMessage").classList.add("d-none");
            showFavoriteCurrencies();
          } else {
            // Request was unsuccessful
            console.error("Error:", xhr.statusText);
            document.getElementById("errorMessage").classList.remove("d-none");
            document.getElementById("successMessage").classList.add("d-none");
          }
        };

        // Define the callback function to handle any error
        xhr.onerror = function() {
          console.error("Error:", xhr.statusText);
          document.getElementById("errorMessage").classList.remove("d-none");
          document.getElementById("successMessage").classList.add("d-none");
        };

        // Convert the form data to JSON string
        const jsonData = JSON.stringify(formData);

        // Send the request with the JSON data
        xhr.send(jsonData);
        
      }).catch(error=>{
        console.error('Error:', error);
      })
  });


const deleteFavoriteCurrencies = (currencyId)=>{
  const id = parseInt(currencyId);
  console.log(id);

  const flag = window.confirm('Are you sure you want to delete it?');
  console.log(flag);
  if(!flag){
    return;
  }
  var xhr = new XMLHttpRequest();
  xhr.open('DELETE', `http://localhost/rahat/api/favorite_currencies/favorite_currencies/${id}`, true);
  xhr.onload = function () {
    if (this.status == 200) {
      showFavoriteCurrencies();
    }
  };
  xhr.send();
}


const editFavoriteCurrencies = (currencyId)=>{
  const id = parseInt(currencyId);

  // Get the result data for the specified resultId
  var xhr = new XMLHttpRequest();
  xhr.open('GET', `http://localhost/rahat/api/favorite_currencies/favorite_currencies/${id}`, true);

  xhr.onload = function() {
    if (this.status == 200) {
      var currency = JSON.parse(this.responseText);
      var currencyId = currency.id;
      var fromCurrency = currency.fromCurrency;
      var toCurrency = currency.toCurrency;

      // Set the form values in the update result modal
      document.getElementById("updateCurrencyId").value = currencyId;
      document.getElementById('updateToCurrency').value = toCurrency;
      document.getElementById('updateFromCurrency').value = fromCurrency;

      // Open the update result modal
      var modal = new bootstrap.Modal(document.getElementById('updateFavoriteCurrencyModal'));
      modal.show();
    }
  };
  xhr.send();

}

const updateCurrencyForm = document.getElementById("updateCurrencyForm");
updateCurrencyForm.addEventListener("submit", function(event){
  event.preventDefault();
  console.log("submit");


  // Get the updated values from the input fields
  let currencyId = document.getElementById('updateCurrencyId').value;
  const updateToCurrency = document.getElementById('updateToCurrency').value;
  const updateFromCurrency = document.getElementById('updateFromCurrency').value;

  currencyId = parseInt(currencyId);


  // Create an object with the updated result data
  const updatedCurrencyData = {
    fromCurrency: updateFromCurrency,
    toCurrency: updateToCurrency
  };

   // Create a new XMLHttpRequest object
  var xhr = new XMLHttpRequest();
  
  // Set the request method and URL
  xhr.open('PUT', 'http://localhost/rahat/api/favorite_currencies/favorite_currencies/' + currencyId, true);

  // Set the request header
  xhr.setRequestHeader('Content-Type', 'application/json');
  
  // Define the callback function for when the request is complete
  xhr.onload = function() {
    if (xhr.status === 200) {
      // Request was successful, handle the response
      const response = JSON.parse(xhr.responseText);
      console.log(response);
      // Additional logic here
      showFavoriteCurrencies();
    } else {
      // Request failed, handle the error
      console.error('Error:', xhr.status);
    }
  };

  // Convert the updated result data to JSON string
  const jsonData = JSON.stringify(updatedCurrencyData);

  // Send the request with the JSON data
  xhr.send(jsonData);

  const updateFavoriteCurrencyModal = new bootstrap.Modal(document.getElementById('updateFavoriteCurrencyModal'));
  updateFavoriteCurrencyModal.hide();

  // Reset the form
  updateCurrencyForm.reset();
})


</script>



<?php  
require "./footer.php"
?>
