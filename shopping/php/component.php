<?php

function component($productid,$productimg, $productname, $productprice,$productdiscount, $productstar)
{
        $element = '
        <div class="col-md-3 col-sm-6 my-3 my-md-0">
            <form action="#" method="post">
                <div class="card shadow my-3">
                    <a href="../../shop/page/detais.php?id='.$productid.'" class="card-fix">
                        <div>
                            <img src="' . $productimg . '" class="img-fluid p-5 card-img-top" alt="">
                        
                        </div>
                        <div class="card-body d-flex flex-column gap-3">
                            <h5 class="card-title card-title-short">' . $productname . '</h5>
                            <h6>';
                                if( $productstar < 5)
                                {
                                    $nullstar = 5 - $productstar ;
                                    $sayac = 0 ;
                                    while($sayac <$productstar)
                                    {    
                                        $element .= '<i class="fas fa-star"></i>';   
                                        $sayac++;
                                    }
                                    $sayac = 0 ;
                                    if($nullstar > 0){
                                        while($sayac < $nullstar)
                                    {
                                        $element .= '<i class="fa-regular fa-star"></i>';   
                                        $sayac++;
                                    }
                                    }
                                }
                                else{
                                    $sayac = 0;
                                    while($sayac <5)
                                    {
                                        $element .= '<i class="fas fa-star"></i>';   
                                        $sayac++;
                                    }
                                }
                            $element .= '</h6>
                            <h5 class="my-2">';
                                if($productdiscount > 0)
                                {$oldformattedPrice = number_format($productprice, 2, ',', '.');
                                    $element .= '<small><small><s>'.$oldformattedPrice.'₺</s></small></small> ';
                                    $newprice = $productprice - ($productprice * $productdiscount / 100);
                                    $formattedPrice = number_format($newprice, 2, ',', '.');
                                    $element .='<span class="price">'.$formattedPrice.'₺</span>';
                                }
                                else{
                                    $formattedPrice = number_format($productprice, 2, ',', '.');
                                    $element .= '<span class="price">'.$formattedPrice.'₺</span>';
                                }
                                
                               // <span class="price">' . $productprice .  '₺</span>
                                //
                                $element .= ' 
                                <input type="hidden" placeholder="'.$productid.'" name="id"></h5>
                        </div>
                    </a>
                </div>
            </form>
        </div>';
    

    // Biriken HTML çıktısını ekrana yazdırın
    echo $element;
}

function category($category){
    // Concatenate the parameter $category to the URL string
    $category ='../../shop/page/category.php?categoryid='.$category;
    
    // Return the modified URL
    return $category;
}
?>

<!-- 
   -->