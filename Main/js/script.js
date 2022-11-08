function getStock(curStock, date){
    let url = `http://iss.moex.com/iss/history/engines/stock/markets/shares/boards/TQBR/securities/${curStock}.json?iss.meta=off&iss.only=history&history.columns=SECID,TRADEDATE,CLOSE,SHORTNAME&limit=1&from=${date}`;
    return url;
}

let btnSearch = document.querySelector('.stock-search');
let stockInput = document.querySelector('.stock-input');
let root = document.querySelector('.info-stock');
let errorBlock = document.querySelector('.error-block')

let now = new Date();
let dateNow = `${now.getFullYear()}-${now.getMonth() + 1}-${now.getDate() - 1}`;
let datePre = `${now.getFullYear() - 3}-${now.getMonth() + 1}-${now.getDate() - 1}`;

let arrInfo = [];
let arrTicker = ['SBER', 'GAZP', 'POSI', 'POLY', 'YNDX', 'ROSN', 'TCSG', 'PLZL', 'NVTK', 'FIVE'];

stockInput.placeholder = `Введите тикер компании, например, ${arrTicker[getRandomNum(0, 9)]}`;

btnSearch.addEventListener('click', function(){

    let curStock = stockInput.value;

    async function getInfoStock(){
        let arrPricePre = [];
    
        const resultNow = await fetch(getStock(curStock, dateNow));
        let res = await resultNow.json();

        const resultPre = await fetch(getStock(curStock, datePre));
        let resPre = await resultPre.json();
    
        let nameCompany = res.history.data[0][3];
        let priceStock = res.history.data[0][2];
        let tickerCost = res.history.data[0][0];
        let pricePre = resPre.history.data[0][2];
        let profit = parseInt((priceStock * 100) / pricePre, 10) - 100;
    
        arrInfo.push(nameCompany);
        arrInfo.push(priceStock);
        arrInfo.push(tickerCost);
        arrInfo.push(profit);

        for(let i = 0; i <= 10; i++){
            dateNow = `${now.getFullYear()}-${i}-${now.getDate() - 3}`;
    
            const resultNow = await fetch(getStock(curStock, dateNow));
            let res = await resultNow.json();
    
            let pricePre = res.history.data[0][2];
            console.log(res);
            arrPricePre.push(pricePre);
        }

        arrInfo.push(arrPricePre);

        return arrInfo;
    }
    
    getInfoStock().then(arrInfo => {
        let info = {
            nameCompany: arrInfo[0],
            priceStock: arrInfo[1],
            tickerCost: arrInfo[2],
            profit: arrInfo[3],
            historyPriceForChart: arrInfo[4],
        };
    
        console.log(info);
    
        const murkup = function(){
            return `<div class="content">
            <div class="header block_style-flex">
              <div class="ticker-company">
                <div class="ticker">
                  <i class="fa-solid fa-arrow-trend-up"></i>
                  Тикер: <span class="_style-info">${info.tickerCost}</span>
                </div>
              </div>
              <div class="button">
                <button type="button" onClick="window.location.reload();" class="btn-close-page btn-style-none"><i class="fa-solid fa-house"></i></button>
              </div>
            </div>
            <div class="chart">
              <canvas id="myChart"></canvas>
            </div>
            <div class="company-main-info block_style-flex">
              <div class="name-company">
                <div class="name">
                  <i class="fa-solid fa-file-signature"></i>
                  Название компании: <span class="_style-info">${info.nameCompany}</span>
                </div>
              </div>
              <div class="price-stock">
                <div class="price">
                  <i class="fa-solid fa-tag"></i>
                  Цена: <span class="_info-price _style-info">${info.priceStock}₽</span>
                </div>
              </div>
            </div>
            <div class="profit-stock">
              <div class="profit-text">
                <i class="fa-solid fa-money-bill-trend-up"></i>
                Доходность за
                3
                года: <span class="profit-span _style-info">${info.profit}%<span>
              </div>
            </div>
            <div class="country-company">
              <div class="country">
                <i class="fa-solid fa-earth-americas"></i>
                <span>Страна: Россия</span>
              </div>
            </div>
            <div class="stock-market">
              <div class="market">
                <i class="fa-solid fa-shop"></i>
                <span>Биржа: Московская биржа</span>
              </div>
            </div>
          </div>`;
        }

        root.innerHTML = murkup();

        let profitSpan = document.querySelector('.profit-span');

        if(info.profit >= 0){
          profitSpan.classList.add('_info-profit_plus');
        }
        else{
          profitSpan.classList.add('_info-profit_minus');
        }

        const labels = [
            'Январь',
            'Февраль',
            'Март',
            'Апрель',
            'Май',
            'Июнь',
            'Июль',
            'Август',
            'Сентябрь',
            'Октябрь',
            'Ноябрь',
          ];
        
          const data = {
            labels: labels,
            datasets: [{
              label: `График цены ${curStock.toUpperCase()}`,
              backgroundColor: 'rgb(123, 196, 68)',
              borderColor: 'rgb(123, 196, 68)',
              data: [
                    info.historyPriceForChart[0], 
                    info.historyPriceForChart[1],
                    info.historyPriceForChart[2],
                    info.historyPriceForChart[2],
                    info.historyPriceForChart[4],
                    info.historyPriceForChart[5],
                    info.historyPriceForChart[6],
                    info.historyPriceForChart[7],
                    info.historyPriceForChart[8],
                    info.historyPriceForChart[9],
                    info.historyPriceForChart[10],
                ],
            }]
          };
        
          const config = {
            type: 'line',
            data: data,
            options: {}
          };
        
           const myChart = new Chart(
            document.getElementById('myChart'),
            config
           );
    
    }).catch(function(error){
      console.log('Caught!', error);
  
      const errorMurkup = function(){
        return `<div class="content-error">
        <div class="error-icon">
          <i class="fa-solid fa-circle-exclamation"></i>
        </div>
        <div class="error-text">
          <div class="error__title">Ой, ошибочка! &#129320;</div>
          <div class="error__text">Возможно вы ввели тикер некорретно или тикер пренадлежит несуществующей компании &#129300;</div>
          <div class="error__try-again">Попробуйте снова 	&#129303;</div>
        </div>
        <div class="error-btn">
          <button onClick="window.location.reload();" class="error__btn-try-again btn-style-none"><i class="fa-solid fa-arrow-rotate-left"></i></button>
        </div>
      </div>`;
      }
  
        errorBlock.innerHTML = errorMurkup();
    });
    
});

function getRandomNum(min, max){
  return Math.floor(Math.random() * (max - min) + min);
}

function refreshPage(){
    window.location.reload();
}


















