            </div>
        </div>
    </div>
    
</section>

    <!-- <div class="container-bottom-bar-solid"></div> -->

   <div class="container-bottom-bar">
       <div class="content-bottom-bar">
           <ul class="b-menus">
            
           <li class="list ">
                <a href="">
                    <span><i class='icon bx bxl-whatsapp'></i></span>
                    <!-- <span class="text">Whatsapp</span> -->
                </a>
            </li>

            <li class="list">
                <a href="">
                    <span><i class='icon bx bxs-heart' ></i></span>
                    <!-- <span class="text">Favorito</span> -->
                </a>
            </li>

            <li class="list <?= selectMenu('') ?>">
                <a href="<?= INCLUDE_PATH ?>">
                    <span><i class='icon bx bxs-hot' ></i></span>
                    <!-- <span class="text">Em alta</span> -->
                </a>
            </li>

            <li class="list <?= selectMenu('cart') ?>">
                <a href="<?= INCLUDE_PATH ?>cart">
                    <span class="f-span"><i class='icon bx bxs-cart'></i><span id="qtd-itens-header-cart"><?php if($qtdCart > 0){?>  <span class="circle-qtd-itens-cart"><?= $qtdCart ?></span>   <?php } ?> </span></span>
                    
                    <!-- <span class="text">Carrinho</span> -->
                </a>
            </li>

            <li class="list">
                <a href="">
                    <span><i class='icon bx bxs-user-circle'></i></span>
                    <!-- <span class="text">Conta</span> -->
                </a>
            </li>

            <!-- <div class="indicator"></div> -->

           </ul>
           

       </div>
   </div>


        <!--========== JS ==========-->
        <script src="<?= INCLUDE_PATH_FULL?>javascript/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

   
       
    </body>
</html>