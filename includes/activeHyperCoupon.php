<div class="col col-12-tl"><!-- split modules/innerCoupon -->
    <div class="innerCoupon sm" data-qcontent="module__innerCoupon">
        <div class="group group--el">
            <div class="col col-9-tl">
                <!--.innerCoupon__subDesc //span Только для Воронежа и Области!
                --><span class="innerCoupon__value">-10%  </span><span class="innerCoupon__desc"> дополнительной скидки по промокоду: </span><span class="innerCoupon__title">8541-632</span>
                <!--.succes //span + Бесплатная доставка в черте города
                -->
            </div>
            <div class="col col-3-tl">
                <div class="countDown">
                    <h6 class="countDown__header">До конца акции осталось:</h6>
                    <div class="countDown__ctn  countDown--innerCoupon" id="countDowninnerCoupon" data-qcontent="component__countDown"></div>
                    <script type="text/javascript">
                         $(document).ready(function(){
                         $('#countDowninnerCoupon').html("...")
                         .countdown("2018/07/12", function(event) {
                         $(this).text(
                         event.strftime('%D Дня %Hч: %Mм: %Sс')
                         );
                         });
                         });



                    </script>
                </div>
            </div>
            <div id="#countDowninnerCoupon"></div>
        </div>
    </div>
</div>
