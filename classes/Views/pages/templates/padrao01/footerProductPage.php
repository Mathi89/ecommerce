            </div>
        </div>
    </div>
    
</section>

    <!-- <div class="container-bottom-bar-solid"></div> -->

   <div class="container-bottom-bar">
       <div class="content-bottom-bar">
           <ul class="b-menus">

<!-- 
           <li class="list">
                <a class="btn_modal_padrao btn_color_modest" href="" >
                    <span>Comprar</span>
                </a>
            </li>
             -->
            <li class="list">
                <div id="add-item" class="btn_modal_padrao btn_blue">
                    <span id="addItemToCart" class="text">Add ao Carrinho</span>
                </div>
            </li>

            


            <!-- <div class="indicator"></div> -->

           </ul>
           

       </div>
   </div>

  <!-- início do preloader -->
  <div id="preloader">
    <div class="inner">
       <!-- HTML DA ANIMAÇÃO MUITO LOUCA DO SEU PRELOADER! -->
       <div class="bolas">
          <div></div>
          <div></div>
          <div></div>                    
       </div>
    </div>
</div>
<!-- fim do preloader --> 

        <!--========== JS ==========-->
        <script>
            var url_bot = "<?= URL_BOT?>";
            var url = "<?= INCLUDE_PATH?>";
        </script>
        <script src="<?= INCLUDE_PATH_FULL?>javascript/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

   
       
    </body>
</html>