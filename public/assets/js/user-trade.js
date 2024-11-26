jQuery(document).ready(function () {

  // Show the crypto assets on the trade page on window load
  if ($("#trade-and-market-common-table").length > 0) {
      update_crypto_assets(apiUrlCrypto);
  }

  // Show the crypto assets on the Market Watch page on window load
  if ($("#market-watch-common-table-area").length > 0) {
      show_assets_marketwatch(apiUrlCrypto);
  }

  // show the timings for the current processing trades on Current Trade section
  if ($("#trade-details-summery-current").length > 0) {
      checkAndUpdateTheCurrentTradesTimings();
  }

});


// Function to handle trade type selection
jQuery(document).on("click", ".trade-type", function () {
  var type = jQuery(this).data("type");
  var searchParameter = jQuery('#searchTableAssets').val().trim();
  const container = jQuery("#trade-and-market-common-table");
  container.empty();

  if (window.innerWidth <= 1024) {
    window.scrollTo(0, 0);
}

  // Clear the container if Forex or Indices is selected
   if (type == "crypto") {
      update_crypto_assets(apiUrlCrypto, searchParameter);
  }else if( type == "forex" ){
      update_forex_assets(apiUrlForex, searchParameter);
  }else if( type == "stocks" ){
      update_stock_assets(apiUrlStocks, searchParameter);
  }else if( type == "indices" ){
    update_indices_assets(apiUrlIndices, searchParameter);
}else if( type == "future" ){
    update_future_assets(apiUrlFutures, searchParameter);
}else if( type == "etfs" ){
    update_etfs_assets(apiUrletfs, searchParameter);
}
  jQuery(".trade-type").removeClass("active");
  jQuery(this).addClass("active");
});

// Function to handle trade type selection
jQuery(document).on("click", ".trade-type-market-watch", function () {
  var type = jQuery(this).data("type");
  var searchParameter = jQuery('#searchTableAssetsMarketWatch').val().trim();
  const container = jQuery("#user-market-watch-table-data");
  container.empty();

  if (window.innerWidth <= 1024) {
    window.scrollTo(0, 0);
}
  // Clear the container if Forex or Indices is selected
   if (type == "crypto") {
      show_assets_marketwatch(apiUrlCrypto, searchParameter, type);
  }else if( type == "forex" ){
      show_assets_marketwatch(apiUrlForex, searchParameter, type);
  }
  else if( type == "indices" ){
      show_assets_marketwatch(apiUrlIndices, searchParameter, type);
  }
  else if( type == "stocks" ){
    show_assets_marketwatch(apiUrlStocks, searchParameter, type);
}
else if( type == "future" ){
    show_assets_marketwatch(apiUrlFutures, searchParameter, type);
}
else if( type == "etfs" ){
    show_assets_marketwatch(apiUrletfs, searchParameter, type);
}
  jQuery(".trade-type-market-watch").removeClass("active");
  jQuery(this).addClass("active");
});

jQuery("#searchTableAssets").on("input", function () {
  var searchParameter = jQuery(this).val().trim();
  var activeType = jQuery(".trade-type.active").data("type");
  if (activeType == "crypto") {
    update_crypto_assets(apiUrlCrypto, searchParameter);
  }else if( activeType == "forex" ){
    update_forex_assets(apiUrlForex, searchParameter);
  }else if( activeType == "stocks" ){
    update_stock_assets(apiUrlStocks, searchParameter);
  }else if( activeType == "indices" ){
    update_indices_assets(apiUrlIndices, searchParameter);
  }else if( activeType == "future" ){
    update_future_assets(apiUrlFutures, searchParameter);
  }else if( activeType == "etfs" ){
    update_etfs_assets(apiUrletfs, searchParameter);
  }
});


// On search on the Market Watch page for the asset
jQuery("#searchTableAssetsMarketWatch").on("input", function () {
  var searchParameter = jQuery(this).val().trim();
  var activeType = jQuery(".trade-type-market-watch.active").data("type");
  if (activeType == "crypto") {
     show_assets_marketwatch(apiUrlCrypto, searchParameter, activeType);
  }else if( activeType == "forex" ){
      show_assets_marketwatch(apiUrlForex, searchParameter, activeType);
  }else if( activeType == "stocks" ){
      show_assets_marketwatch(apiUrlStocks, searchParameter, activeType);
  }else if( activeType == "indices" ){
    show_assets_marketwatch(apiUrlIndices, searchParameter, activeType);
}
else if( activeType == "future" ){
    show_assets_marketwatch(apiUrlFutures, searchParameter, activeType);
}
else if( activeType == "etfs" ){
    update_etfs_assets(apiUrletfs, searchParameter, activeType);
}
});


// Trade page functions
function update_crypto_assets(apiUrlCrypto, searchTerm = "") {
  fetch(apiUrlCrypto)
    .then((response) => response.json())
    .then((data) => {
      const container = document.getElementById(
        "trade-and-market-common-table"
      );
      container.innerHTML = ""; // Clear the existing content

      const filteredData = data.filter((pair) => {
        const firstWordName = pair.name.split(" ")[0].toLowerCase();
        const firstWordSymbol = pair.symbol.toLowerCase();

        // Check if the first word matches the search term (case insensitive)
        return firstWordName.startsWith(searchTerm.toLowerCase()) ||
               firstWordSymbol.startsWith(searchTerm.toLowerCase());
    });

      filteredData.forEach((pair) => {
        const crypto_current_price = pair.current_price;
        const crypto_name = pair.name;
        const crypto_market = "crypto";
        // Create a <dt> element
        const dtElement = document.createElement("dt");
        dtElement.className =
          "d-flex justify-content-between align-items-center g-10 asset-data";
        dtElement.dataset.symbol = pair.symbol.toUpperCase(); // Add symbol for click handling

        // Create the inner HTML content
        let cryptoassetdata = '<div class="country-name d-flex align-items-center g-8">';
        cryptoassetdata +='<img class="flag" src="' + pair.image +'" alt="' +pair.name +' logo">';
        cryptoassetdata += '<span class="details"';
        cryptoassetdata += ' data-price="' + crypto_current_price + '"';
        cryptoassetdata += ' data-name="' + crypto_name + '"';
        cryptoassetdata += ' data-image="' + pair.image + '"';
        cryptoassetdata += ' data-market="' + crypto_market + '"';
        cryptoassetdata += ' data-fullname="' + pair.symbol.toUpperCase() + ' / U.S Dollar">';
        cryptoassetdata += pair.symbol.toUpperCase() + "/USD";
        cryptoassetdata += "</span>";
        cryptoassetdata += "</div>";
        cryptoassetdata += '<div class="pair-price">$' + pair.current_price.toFixed(2) + "</div>";
        cryptoassetdata += '<div class="percentage ' +(pair.price_change_percentage_24h < 0 ? "text-danger" : "text-success") + '">';
        cryptoassetdata += pair.price_change_percentage_24h.toFixed(2) + "%";
        cryptoassetdata += "</div>";

        // Set the inner HTML of the dtElement
        dtElement.innerHTML = cryptoassetdata;

        // Append the dtElement to the container
        container.appendChild(dtElement);

        // Add click event listener to the dtElement
        dtElement.addEventListener("click", function () {
          loadTradingViewChart(pair.symbol.toUpperCase() + "USD");
        });
      });

      // Trigger click on the first <dt> element to load the chart by default
      if (filteredData.length > 0) {
        jQuery("#trade-and-market-common-table").find("dt:first").click();
      }
    })
    .catch((error) => console.error("Error fetching data:", error));
}

function update_forex_assets(apiUrlForex, searchTerm = "") {
  fetch(apiUrlForex)
    .then((response) => response.json())
    .then((data) => {
      const container = document.getElementById("trade-and-market-common-table");
      container.innerHTML = ""; // Clear the existing content

      const filteredData = data.filter((pair) => {
        const firstWordSymbol = pair.symbol.split("/")[0].toLowerCase();
        return firstWordSymbol.startsWith(searchTerm.toLowerCase());
      });

      filteredData.forEach((pair) => {
        const forex_current_price = parseFloat(pair.current_price).toFixed(4);
        const forex_symbol = pair.symbol;
        const market = "forex";

        // Create a <dt> element
        const dtElement = document.createElement("dt");
        dtElement.className = "d-flex justify-content-between align-items-center g-10 asset-data";
        dtElement.dataset.symbol = pair.symbol.toUpperCase(); // Add symbol for click handling

        // Create the inner HTML content
        let forexAssetData = '<div class="country-name d-flex align-items-center g-8">';
        forexAssetData += '<img class="flag" src="' + pair.base_currency_image + '" alt="' + pair.symbol + ' logo">';
        // forexAssetData += '<img class="flag" src="' + pair.quote_currency_image + '" alt="' + pair.symbol + ' logo">';
        forexAssetData += '<span class="details"';
        forexAssetData += ' data-price="' + forex_current_price + '"';
        forexAssetData += ' data-symbol="' + forex_symbol + '"';
        forexAssetData += ' data-image="' + pair.base_currency_image + '"';
        forexAssetData += ' data-name="' + pair.symbol + '"';
        forexAssetData += ' data-market="' + market + '"';
        forexAssetData += ' data-fullname="' + pair.name + '">';
        forexAssetData += forex_symbol.toUpperCase();
        forexAssetData += "</span>";
        forexAssetData += "</div>";
        forexAssetData += '<div class="pair-price">$' + forex_current_price + "</div>";
        forexAssetData += '<div class="percentage ' + (parseFloat(pair.percentage_change) < 0 ? "text-danger" : "text-success") + '">';
        forexAssetData += pair.percentage_change;
        forexAssetData += "</div>";

        // Set the inner HTML of the dtElement
        dtElement.innerHTML = forexAssetData;

        // Append the dtElement to the container
        container.appendChild(dtElement);

        // Add click event listener to the dtElement
        dtElement.addEventListener("click", function () {
          loadTradingViewChart('FX_IDC:' + pair.symbol.replace('/', ''));
        });
      });

      // Trigger click on the first <dt> element to load the chart by default
      if (filteredData.length > 0) {
        jQuery("#trade-and-market-common-table").find("dt:first").click();
      }
    })
    .catch((error) => console.error("Error fetching data:", error));
}


function update_stock_assets(apiUrlStocks, searchTerm = "") {
    fetch(apiUrlStocks)
      .then((response) => response.json())
      .then((data) => {
        const container = document.getElementById("trade-and-market-common-table");
        container.innerHTML = "";

        const filteredData = data.filter((pair) => {
            const firstWordName = pair.name.split(" ")[0].toLowerCase();
            const firstWordSymbol = pair.symbol.toLowerCase();

            return firstWordName.startsWith(searchTerm.toLowerCase()) ||
                   firstWordSymbol.startsWith(searchTerm.toLowerCase());
          });

          filteredData.forEach((pair) => {
            const pair_current_price = pair.current_price;
            // const pair_name = pair.symbol;
            const market = "stocks";

            const dtElement = document.createElement("dt");
            dtElement.className =
              "d-flex justify-content-between align-items-center g-10 asset-data";
            dtElement.dataset.symbol = pair.symbol.toUpperCase();

            // Create the inner HTML content
            let stocksAssetData = '<div class="country-name d-flex align-items-center g-8">';
            stocksAssetData += '<img class="flag" src="' + pair.logo + '" alt="' + pair.symbol + ' logo">';
            // forexAssetData += '<img class="flag" src="' + pair.quote_currency_image + '" alt="' + pair.symbol + ' logo">';
            stocksAssetData += '<span class="details"';
            stocksAssetData += ' data-price="' + pair_current_price + '"';
            stocksAssetData += ' data-symbol="' + pair.symbol + '"';
            stocksAssetData += ' data-image="' + pair.logo + '"';
            stocksAssetData += ' data-market="' + market + '"';
            stocksAssetData += ' data-name="' + pair.symbol + '"';
            stocksAssetData += ' data-fullname="' + pair.name + '">';
            stocksAssetData += pair.symbol.toUpperCase();
            stocksAssetData += "</span>";
            stocksAssetData += "</div>";
            stocksAssetData += '<div class="pair-price">$' +  pair_current_price+ "</div>";
            stocksAssetData += '<div class="percentage ' + (parseFloat(pair.percent_change) < 0 ? "text-danger" : "text-success") + '">';
            stocksAssetData += pair.percent_change;
            stocksAssetData += "</div>";

            dtElement.innerHTML = stocksAssetData;

            container.appendChild(dtElement);

            dtElement.addEventListener("click", function () {
              loadTradingViewChart(pair.symbol.toUpperCase());
            });
          });

        if (filteredData.length > 0) {
          jQuery("#trade-and-market-common-table").find("dt:first").click();
        }
      })
      .catch((error) => console.error("Error fetching data:", error));
  }

  function update_indices_assets(apiUrlIndices, searchTerm = "") {
    fetch(apiUrlIndices)
      .then((response) => response.json())
      .then((data) => {
        const container = document.getElementById(
          "trade-and-market-common-table"
        );
        container.innerHTML = ""; // Clear the existing content

        const filteredData = data.filter((pair) => {
          const firstWordName = pair.company_name.split(" ")[0].toLowerCase();
          const firstWordSymbol = pair.symbol.toLowerCase();

          // Check if the first word matches the search term (case insensitive)
          return firstWordName.startsWith(searchTerm.toLowerCase()) ||
                 firstWordSymbol.startsWith(searchTerm.toLowerCase());
      });

        filteredData.forEach((pair) => {
          const current_price = pair.current_price;
          const name = pair.company_name;
          const market = "indices";
          // Create a <dt> element
          const dtElement = document.createElement("dt");
          dtElement.className =
            "d-flex justify-content-between align-items-center g-10 asset-data";
          dtElement.dataset.symbol = pair.symbol.toUpperCase(); // Add symbol for click handling

          // Create the inner HTML content
          let indicesassetdata = '<div class="country-name d-flex align-items-center g-8">';
          indicesassetdata +='<img class="flag" src="' + pair.logo +'" alt="' +pair.symbol +' logo">';
          indicesassetdata += '<span class="details"';
          indicesassetdata += ' data-price="' + current_price + '"';
          indicesassetdata += ' data-name="' + name + '"';
          indicesassetdata += ' data-market="' + market + '"';
          indicesassetdata += ' data-image="' + pair.logo + '"';

          indicesassetdata += ' data-fullname="' + pair.symbol.toUpperCase() + ' ">';

          indicesassetdata += pair.symbol.toUpperCase() ;
          indicesassetdata += "</span>";
          indicesassetdata += "</div>";
          indicesassetdata += '<div class="pair-price">$' + pair.current_price.toFixed(2) + "</div>";
          indicesassetdata += '<div class="percentage ' +(pair.change_percentage < 0 ? "text-danger" : "text-success") + '">';
          indicesassetdata += pair.change_percentage.toFixed(2) + "%";
          indicesassetdata += "</div>";

          // Set the inner HTML of the dtElement
          dtElement.innerHTML = indicesassetdata;

          // Append the dtElement to the container
          container.appendChild(dtElement);

          // Add click event listener to the dtElement
          dtElement.addEventListener("click", function () {
            loadTradingViewChart(pair.symbol.toUpperCase());
          });
        });

        // Trigger click on the first <dt> element to load the chart by default
        if (filteredData.length > 0) {
          jQuery("#trade-and-market-common-table").find("dt:first").click();
        }
      })
      .catch((error) => console.error("Error fetching data:", error));
  }

  function update_future_assets(apiUrlFutures, searchTerm = "") {
    fetch(apiUrlFutures)
      .then((response) => response.json())
      .then((data) => {
        const container = document.getElementById(
          "trade-and-market-common-table"
        );
        container.innerHTML = ""; // Clear the existing content

        const filteredData = data.filter((pair) => {
          const firstWordName = pair.company_name.split(" ")[0].toLowerCase();
          const firstWordSymbol = pair.symbol.toLowerCase();

          // Check if the first word matches the search term (case insensitive)
          return firstWordName.startsWith(searchTerm.toLowerCase()) ||
                 firstWordSymbol.startsWith(searchTerm.toLowerCase());
      });

        filteredData.forEach((pair) => {
          const current_price = pair.regularMarketPrice;
          const name = pair.company_name;
          const market = "futures";
          // Create a <dt> element
          const dtElement = document.createElement("dt");
          dtElement.className =
            "d-flex justify-content-between align-items-center g-10 asset-data";
            dtElement.dataset.symbol = pair.symbol.toUpperCase().replace('=F', ''); // Add symbol for click handling

          // Create the inner HTML content
          let indicesassetdata = '<div class="country-name d-flex align-items-center g-8">';
          indicesassetdata +='<img class="flag" src="' + pair.logo_url +'" alt="' +pair.symbol.replace('=F', '') +' logo">';
          indicesassetdata += '<span class="details"';
          indicesassetdata += ' data-price="' + current_price + '"';
          indicesassetdata += ' data-name="' + name + '"';
          indicesassetdata += ' data-market="' + market + '"';
          indicesassetdata += ' data-image="' + pair.logo_url + '"';
          indicesassetdata += ' data-fullname="' + pair.symbol.replace('=F', '').toUpperCase() + '">';
          indicesassetdata += pair.symbol.replace('=F', '').toUpperCase() ;
          indicesassetdata += "</span>";
          indicesassetdata += "</div>";
          indicesassetdata += '<div class="pair-price">$' + current_price.toFixed(2) + "</div>";
          indicesassetdata += '<div class="percentage ' +(pair.change_percentage < 0 ? "text-danger" : "text-success") + '">';
          indicesassetdata += pair.change_percentage.toFixed(2) + "%";
          indicesassetdata += "</div>";

          // Set the inner HTML of the dtElement
          dtElement.innerHTML = indicesassetdata;

          // Append the dtElement to the container
          container.appendChild(dtElement);

          // Add click event listener to the dtElement
          dtElement.addEventListener("click", function () {
            loadTradingViewChart(pair.symbol.toUpperCase().replace('=F', ''));
        });
        });

        // Trigger click on the first <dt> element to load the chart by default
        if (filteredData.length > 0) {
          jQuery("#trade-and-market-common-table").find("dt:first").click();
        }
      })
      .catch((error) => console.error("Error fetching data:", error));
  }

  function update_etfs_assets(apiUrletfs, searchTerm = "") {
    fetch(apiUrletfs)
      .then((response) => response.json())
      .then((data) => {
        const container = document.getElementById(
          "trade-and-market-common-table"
        );
        container.innerHTML = ""; // Clear the existing content

        const filteredData = data.filter((pair) => {
          const firstWordName = pair.name.split(" ")[0].toLowerCase();
          const firstWordSymbol = pair.symbol.toLowerCase();

          // Check if the first word matches the search term (case insensitive)
          return firstWordName.startsWith(searchTerm.toLowerCase()) ||
                 firstWordSymbol.startsWith(searchTerm.toLowerCase());
      });

        filteredData.forEach((pair) => {
          const current_price = pair.current_price;
          const name = pair.name;
          const market = "etfs";
          // Create a <dt> element
          const dtElement = document.createElement("dt");
          dtElement.className =
            "d-flex justify-content-between align-items-center g-10 asset-data";
          dtElement.dataset.symbol = pair.symbol.toUpperCase(); // Add symbol for click handling

          // Create the inner HTML content
          let indicesassetdata = '<div class="country-name d-flex align-items-center g-8">';
          indicesassetdata +='<img class="flag" src="' + pair.logo_url +'" alt="' +pair.symbol +' logo">';
          indicesassetdata += '<span class="details"';
          indicesassetdata += ' data-price="' + current_price + '"';
          indicesassetdata += ' data-name="' + name + '"';
          indicesassetdata += ' data-market="' + market + '"';
          indicesassetdata += ' data-image="' + pair.logo_url + '"';

          indicesassetdata += ' data-fullname="' + pair.symbol.toUpperCase() + ' ">';

          indicesassetdata += pair.symbol.toUpperCase() ;
          indicesassetdata += "</span>";
          indicesassetdata += "</div>";
          indicesassetdata += '<div class="pair-price">$' + pair.current_price.toFixed(2) + "</div>";
          indicesassetdata += '<div class="percentage ' +(pair.change_percent < 0 ? "text-danger" : "text-success") + '">';
          indicesassetdata += pair.change_percent.toFixed(2) + "%";
          indicesassetdata += "</div>";

          // Set the inner HTML of the dtElement
          dtElement.innerHTML = indicesassetdata;

          // Append the dtElement to the container
          container.appendChild(dtElement);

          // Add click event listener to the dtElement
          dtElement.addEventListener("click", function () {
            loadTradingViewChart(pair.symbol.toUpperCase());
          });
        });

        // Trigger click on the first <dt> element to load the chart by default
        if (filteredData.length > 0) {
          jQuery("#trade-and-market-common-table").find("dt:first").click();
        }
      })
      .catch((error) => console.error("Error fetching data:", error));
  }


function loadTradingViewChart(symbol) {
  // Get the container element
  const container = document.getElementById("market-watch-chart");
  // Set the chart width and height based on the container's size
  const chartWidth = container.offsetWidth;
  const chartHeight = window.innerHeight * 0.7; // 70% of the window height, adjust as needed

  new TradingView.widget({
    width: chartWidth,
    height: chartHeight,
    symbol: symbol,
    interval: "D",
    timezone: "Etc/UTC",
    theme: "light",
    style: "1",
    locale: "en",
    toolbar_bg: "#f1f3f6",
    enable_publishing: false,
    allow_symbol_change: true,
    container_id: "market-watch-chart",
  });
}


// Market Watch functions
function show_assets_marketwatch(apiUrl, searchTerm = "", type = "crypto") {
  fetch(apiUrl)
    .then((response) => response.json())
    .then((data) => {
      const container = document.getElementById("user-market-watch-table-data");
      container.innerHTML = "";
      setTableHeadersMarketWatch(type);

      const filteredData = data.filter((item) => {
        // const firstWordName = item.name.split(" ")[0].toLowerCase();
        // const nameToCheck = (type === 'indices') ? item.company_name : item.name;
        const nameToCheck = (type === 'indices' || type === 'future') ? item.company_name : item.name;
        const firstWordName = nameToCheck.split(" ")[0].toLowerCase();
        const firstWordSymbol = item.symbol.toLowerCase();
        return firstWordName.startsWith(searchTerm.toLowerCase()) || firstWordSymbol.startsWith(searchTerm.toLowerCase());
      });

      if (filteredData.length === 0) {
        container.innerHTML = "<tr><td colspan='6'>No results found</td></tr>";
        return;
      }

      filteredData.forEach((item) => {
        let table_row_html = "<tr>";

        table_row_html += "<td>";
        table_row_html += '<div class="d-flex align-items-center g-8">';
        if (type === 'crypto') {
          table_row_html += `<img src="${item.image}" class="icon crypto_image" alt="${item.name}" style="width: 30px; height: 30px; border-radius:50%">`;
        } else if (type === 'forex') {
          table_row_html += `<img src="${item.base_currency_image}" class="icon" alt="${item.name}" style="width: 30px; height: 30px; border-radius:50%">`;
        }
        else if (type === 'stocks') {
            table_row_html += `<img src="${item.logo}" class="icon" alt="${item.name}" style="width: 30px; height: 30px; border-radius:50%">`;
          }
          else if (type === 'indices') {
            table_row_html += `<img src="${item.logo}" class="icon" alt="${item.company_name}" style="width: 30px; height: 30px; border-radius:50%">`;
          }
          else if (type === 'future') {
            table_row_html += `<img src="${item.logo_url}" class="icon" alt="${item.company_name}" style="width: 30px; height: 30px; border-radius:50%">`;
          }else if (type === 'etfs') {
            table_row_html += `<img src="${item.logo_url}" class="icon" alt="${item.name}" style="width: 30px; height: 30px; border-radius:50%">`;
          }
        // table_row_html += `<span>${item.symbol}</span>`;
        table_row_html += `<span>${item.symbol.replace('=F', '').toUpperCase()}</span>`;

        table_row_html += "</div></td>";

        if (type === 'crypto') {
          table_row_html += `<td>${item.market_cap.toLocaleString()}</td>`;
          table_row_html += `<td>${item.current_price.toLocaleString()}</td>`;
          table_row_html += `<td>${item.total_volume.toLocaleString()}</td>`;
          table_row_html += `<td>${item.circulating_supply.toLocaleString()}</td>`;
          table_row_html += `<td style="color: ${(item.price_change_percentage_24h < 0 ? "red" : "green")}">${item.price_change_percentage_24h.toFixed(2)}%</td>`;
        } else if (type === 'forex') {
          table_row_html += `<td>${item.current_price}</td>`;
          table_row_html += `<td>${item.open_price}</td>`;
          table_row_html += `<td>${item.high_24h}</td>`;
          table_row_html += `<td>${item.low_24h}</td>`;
          table_row_html += `<td style="color: ${(item.percentage_change.startsWith('-') ? "red" : "green")}">${item.percentage_change}</td>`;
        }
        else if (type === 'stocks') {
            table_row_html += `<td>${item.type}</td>`;
            table_row_html += `<td>${item.current_price}</td>`;
            table_row_html += `<td>${item.high}</td>`;
            table_row_html += `<td>${item.low}</td>`;
            table_row_html += `<td style="color: ${(item.percent_change < 0 ? "red" : "green")}">${item.percent_change.toFixed(2)}%</td>`;

          }
          else if (type === 'indices') {
            table_row_html += `<td>${item.volume}</td>`;
            table_row_html += `<td>${item.current_price}</td>`;
            table_row_html += `<td>${item.high_price}</td>`;
            table_row_html += `<td>${item.low_price}</td>`;
            table_row_html += `<td style="color: ${(item.change_percentage < 0 ? "red" : "green")}">${item.change_percentage.toFixed(2)}%</td>`;

          }
          else if (type === 'future') {
            table_row_html += `<td>${item.regularMarketVolume}</td>`;
            table_row_html += `<td>${item.regularMarketPrice}</td>`;
            table_row_html += `<td>${item.regularMarketDayHigh}</td>`;
            table_row_html += `<td>${item.regularMarketDayLow}</td>`;
            table_row_html += `<td style="color: ${(item.change_percentage < 0 ? "red" : "green")}">${item.change_percentage.toFixed(2)}%</td>`;

          }
          else if (type === 'etfs') {
            table_row_html += `<td>${item.fifty_day_average}</td>`;
            table_row_html += `<td>${item.current_price}</td>`;
            table_row_html += `<td>${item.fifty_two_week_high}</td>`;
            table_row_html += `<td>${item.fifty_two_week_low}</td>`;
            table_row_html += `<td style="color: ${(item.change_percent < 0 ? "red" : "green")}">${item.change_percent.toFixed(2)}%</td>`;

          }
        table_row_html += "</tr>";
        container.innerHTML += table_row_html;
      });
    })
    .catch((error) => console.error("Error fetching data:", error));
}

function setTableHeadersMarketWatch(type) {
  const container = document.querySelector('.user-market-watch-table thead tr');
  container.innerHTML = '';

  let headers = [];

  if (type === 'crypto') {
    headers = ['Asset', 'Market Cap', 'Price', 'Traded Volume', 'Available Volume', 'Change'];
  } else if (type === 'forex') {
    headers = ['Asset', 'Price', 'Open Price', 'High 24h', 'Low 24h', 'Change'];
  } else if (type === 'stocks') {
    headers = ['Asset', 'Type', 'Price', 'High 24h', 'Low 24h','Change'];
  }else if (type === 'indices') {
    headers = ['Asset', 'Volume', 'Price', 'High 24h', 'Low 24h','Change'];
  }else if (type === 'future') {
    headers = ['Asset', 'Volume', 'Price', 'High 24h', 'Low 24h','Change'];
  }else if (type === 'etfs') {
    headers = ['Asset', 'Average', 'Price', 'High ', 'Low ','Change'];
  }

  headers.forEach(header => {
    const th = document.createElement('th');
    th.textContent = header;
    container.appendChild(th);
  });
}





// Section of the js for handling the trade process logic
// on selecting the assets for doing the trade
jQuery(document).on("click", "#trade-and-market-common-table .asset-data", function () {
  let name = jQuery(this).find("span").data("name");
  let fullname = jQuery(this).find("span").data("fullname");
  let assetPrice = jQuery(this).find("span").data("price");
  let assetImage = jQuery(this).find("span").data("image");
  let market = jQuery(this).find("span").data("market");


  jQuery(".user-trade-chart-filter .selected-asset").find(".name").text(name);
  jQuery(".user-trade-chart-filter .selected-asset").find(".fullname").text(fullname);
  jQuery("input.asset-unitprice").val(assetPrice);
  jQuery("input.name_input").val(name);
  jQuery("input.asset_market").val(market);
  jQuery("input.image").val(assetImage);
  jQuery(".flag_image").attr("src", assetImage).show();

  $(".btn-buy .buy_price").text(assetPrice).attr("value", assetPrice);
  $(".btn-sell .sell_price").text(assetPrice).attr("value", assetPrice);

  document.querySelector("input.asset-contract-size").value = 0;
  jQuery(".user-trade-chart-filter .asset-contract-size").text(0);
  jQuery(".user-trade-chart-filter .asset-unit-price").val(0);
  jQuery(".user-trade-chart-filter .asset-payout").text(0);
  document.querySelector("input.payout").value = 0;
  jQuery(".user-trade-chart-filter .asset-trade-amount").val(0);
}
);

// on updating Margin
jQuery(".user-trade-chart-filter .asset-margin").on("change", function () {
  trade_logic();
});

// on enter trade amountasset-contract-size-hidden
jQuery(document).on("input", ".user-trade-chart-filter .asset-trade-amount", function () {
  trade_logic();
});

// check for the user balanc if greater than he is trying to do the trade
jQuery("#tradeForm").on("submit", function (event) {
  var userBalance = parseFloat($(".asset-user_balance").val());
  var amount = parseFloat($(".asset-trade-amount").val());
  if (amount > userBalance) {
    event.preventDefault();
    document.getElementById("insufficientBalanceModal").style.display = "block";
  }
});

jQuery(document).on( 'click', '.close-button', function(){
  jQuery('#insufficientBalanceModal').hide();
});

window.onclick = function (event) {
  if( jQuery('#insufficientBalanceModal').length > 0 ){
    jQuery('#insufficientBalanceModal').hide();
  }
};


function trade_logic() {
  let asset_price = jQuery(".user-trade-chart-filter .asset-unitprice").val();
  let margin = jQuery(".user-trade-chart-filter .asset-margin").val();
  let asset_trade_amount = jQuery(
    ".user-trade-chart-filter .asset-trade-amount"
  ).val();
  let trade_percentage = jQuery(
    ".user-trade-chart-filter .asset-trade_result_percentage"
  ).val();

  let contract_size, asset_unit_price, payout;

  if (asset_trade_amount > 0) {
    let contract_size = asset_trade_amount * margin;
    let asset_unit_price = contract_size / asset_price;
    let payout =
      (parseFloat(contract_size) * parseFloat(trade_percentage)) / 100 +
      parseFloat(asset_trade_amount);
    document.querySelector("input.asset-contract-size").value = contract_size;

    jQuery(".user-trade-chart-filter .asset-contract-size").text(contract_size);
    jQuery(".user-trade-chart-filter .asset-unit-price").val(asset_unit_price);
    jQuery(".user-trade-chart-filter .asset-payout").text(payout);

    document.querySelector("input.payout").value = payout;
  } else {
    contract_size = "0";
    asset_unit_price = "0";

    jQuery(".user-trade-chart-filter .asset-contract-size").text(contract_size);
    jQuery(".user-trade-chart-filter .asset-unit-price").val(asset_unit_price);
  }
}


function checkAndUpdateTheCurrentTradesTimings(){
  $("#trade-details-summery-current tbody tr").each(function () {

    var trade_id = $(this).data("id");
    var pnl_value = parseFloat($(this).find(".pnl_value").val());
    var trade_created = $(this).find(".trade_created").val();
    var current_date_time = $(this).find(".current_date_time").val();
    var time_frame = $(this).find(".timeframe").val();

    var tradeCreatedDate = new Date(trade_created);
    var currentDateTime = new Date(current_date_time);

    var timeDifference = currentDateTime - tradeCreatedDate;
    var timeFrameInMilliseconds;
    switch (time_frame) {
      case "5minutes":
        timeFrameInMilliseconds = 5 * 60 * 1000;
        break;
      case "30minutes":
        timeFrameInMilliseconds = 30 * 60 * 1000;
        break;
      case "1hour":
        timeFrameInMilliseconds = 1 * 60 * 60 * 1000;
        break;
      case "4hours":
        timeFrameInMilliseconds = 4 * 60 * 60 * 1000;
        break;
      case "1day":
        timeFrameInMilliseconds = 24 * 60 * 60 * 1000;
        break;
      case "1week":
        timeFrameInMilliseconds = 7 * 24 * 60 * 60 * 1000;
        break;
      case "1month":
        timeFrameInMilliseconds = 30 * 24 * 60 * 60 * 1000;
        break;
      case "1year":
        timeFrameInMilliseconds = 365 * 24 * 60 * 60 * 1000;
        break;
      default:
        timeFrameInMilliseconds = 0;
        break;
    }

    var sign = pnl_value < 0 ? "-" : "+";
    pnl_value = Math.abs(pnl_value);

    var remainingTime = timeFrameInMilliseconds - timeDifference;


    function formatTime(ms) {
      if (ms <= 0) {
        return;
      }

      var totalSeconds = Math.floor(ms / 1000);

      var days = Math.floor(totalSeconds / (24 * 60 * 60));
      var hours = Math.floor((totalSeconds % (24 * 60 * 60)) / (60 * 60));
      var minutes = Math.floor((totalSeconds % (60 * 60)) / 60);
      var seconds = totalSeconds % 60;

      if (days > 0) {
        return days + " day" + (days > 1 ? "s" : "") + " left";
      } else if (hours > 0) {
        return hours + " hour" + (hours > 1 ? "s" : "") + " left";
      } else if (minutes > 0) {
        return (
          minutes + ":" + (seconds < 10 ? "0" : "") + seconds + " min left"
        );
      } else {
        return seconds + " second" + (seconds > 1 ? "s" : "") + " left";
      }
    }


    var timeDisplayElement = $(this).find(".remaining_time");
    timeDisplayElement.text(formatTime(remainingTime));
    var interval = setInterval(function () {
      remainingTime -= 1000;

      var formattedTime = formatTime(remainingTime);
      timeDisplayElement.text(formattedTime);

      if (remainingTime <= 0) {
        clearInterval(interval);
      }
    }, 1000);

    // If the trade has expired, show the full PnL value and stop updating
    if (timeDifference >= timeFrameInMilliseconds) {
      $(this).find(".trade_pnl_value .amount").text(pnl_value.toFixed(2));
      $(this).find(".trade_pnl_value .sign").text(sign);
      sign == "-"
        ? $(this).find(".trade_pnl_value").css("color", "#F32524")
        : $(this).find(".trade_pnl_value").css("color", "#3AA31A");

    } else {
      var currentPnl = 0;
      var updateInterval = 1000;

      function getDynamicIncrements(pnl_value) {
        let increments = [];
        if (pnl_value <= 1000) {
          increments = [1, 5, 10, 20, 50];
        } else if (pnl_value <= 10000) {
          increments = [10, 50, 100, 200, 500];
        } else {
          increments = [100, 500, 1000, 5000, 10000];
        }
        return increments;
      }

      $(this).find(".trade_pnl_value .sign").text(sign);

      let increments = getDynamicIncrements(pnl_value);
      var interval = setInterval(
        function () {
          remainingTime -= 1000;

          timeDisplayElement.text(formatTime(remainingTime));

          let randomIncrement =
            increments[Math.floor(Math.random() * increments.length)];
          currentPnl += randomIncrement;

          if (currentPnl >= pnl_value) {
            currentPnl = getRandomInRange(pnl_value - 20, pnl_value);
          }

          if (remainingTime <= 0) {
            currentPnl = pnl_value;
            clearInterval(interval);
            timeDisplayElement.text("00:00");
          }

          $(this)
            .find(".trade_pnl_value .amount")
            .text(Math.abs(currentPnl.toFixed(2)));
          sign == "-"
            ? $(this).find(".trade_pnl_value").css("color", "#F32524")
            : $(this).find(".trade_pnl_value").css("color", "#3AA31A");
        }.bind(this),
        updateInterval
      );
    }
  });
}


function getRandomInRange(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}
