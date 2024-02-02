<div class="container p-5">
    
        <div class="row">
            <?php $userdate = explode("-", $_SESSION["array"][$usrid]["date"]);?>
            
            <div class="col-md-6 col-12 border-0 px-5 py-3 d-flex flex-column justify-content-center align-items-center gap-2"
                style="min-height:200px">
                
                <div class="card-title w-100 px-3 mb-3 border-1 border-bottom border-warning text-warning"
                    style="text-align:left;">
                    <h6>Kullanıcı bilgileri</h6>
                </div>
                <div class="item w-100 d-flex flex-rows gap-5 justify-content-center" style="text-align:left;">
                    <div class="input w-100 d-flex flex-column ">
                        <label for="name" class="form-label">Ad</label>
                        <input type="text" name="name" id="name"
                            value="<?php echo ucfirst($_SESSION["array"][$usrid]["adi"]); ?>" class="form-control">
                    </div>
                    <div class="input w-100 d-flex flex-column">
                        <label for="surname" class="form-label">Soyad</label>
                        <input type="text" name="surname" id="surname"
                            value="<?php echo ucfirst($_SESSION["array"][$usrid]["soyad"]); ?>" class="form-control">
                    </div>
                </div>
                <div class="input  w-100 d-flex flex-column">
                    <label for="mail" class="form-label ">E-Mail</label>
                    <input type="email" name="mail" id="mail"
                        value="<?php echo ucfirst($_SESSION["array"][$usrid]["mail"]); ?>" class="form-control">
                </div>
                <div class="input  w-100 d-flex flex-column">
                    <label for="tel" class="form-label ">Telefon</label>

                    <div class="input-group">
                        <select class="form-select">
                            <option selected value="+90">+90</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <input type="tel" name="tel" id="tel"
                            value="<?php echo ucfirst($_SESSION["array"][$usrid]["tel"]); ?>" class="form-control w-75">
                    </div>
                </div>
                <div class="input w-100 d-flex flex-column">
                    <label class="form-label ">Doğum Tarihi</label>
                    <div class="input-group d-flex gap-2 justify-content-evenly align-items-center">

                        <select class="form-select" name="dday" id="dday">
                            <?php 
                        $day = 1;
                        while($day <32)
                        {
                            ?> <option value="<?php echo $day; ?>" <?php 
                            if($day == $userdate[2])
                            {
                                echo "selected";
                            }
                        ?>><?php echo $day; ?></option> <?php
                            $day += 1; 
                        }


                    
                    ?>
                        </select>

                        <select name="dmount" class="form-select " style="min-width:150px">
                            <?php 
                        
                        $aylar = array(
                            "1" => "Ocak",
                            "2" => "Şubat",
                            "3" => "Mart",
                            "4" => "Nisan",
                            "5" => "Mayıs",
                            "6" => "Haziran",
                            "7" => "Temmuz",
                            "8" => "Ağustos",
                            "9" => "Eylül",
                            "10" => "Ekim",
                            "11" => "Kasım",
                            "12" => "Aralık",
                        );
                        $deger = 1;

                        while($deger < 13)
                        {
                            ?><option value="<?php echo $deger ?>"
                                <?php if($deger == $userdate[1]){ echo "selected";} ?>><?php echo $aylar[$deger]; ?>
                            </option><?php
                            $deger +=1;
                        }
                        ?>
                        </select>
                        <select name="dyear" class="form-select " id="" style="min-width:100px;">
                            <?php 
                        $nowyear =    date("Y");
                        $limityear = $nowyear - 50;
                        
                        while($nowyear >$limityear)
                        {?>
                            <option value="<?php echo $nowyear; ?>" <?php 
                            if($nowyear == $userdate[0])
                            {
                                echo "selected";
                            }
                        ?>><?php echo $nowyear ;?></option>
                            <?php    
                            $nowyear -= 1;

                        }
                    
                    ?>
                        </select>
                    </div>

                </div>
            </div>
            <div class="col-md-6 col-12 border-0 px-5 py-3 d-flex flex-column justify-content-center align-items-center gap-2"
                style="min-height:200px;">
                <div class="card-title w-100 px-3 mb-4 border-1 border-bottom border-warning text-warning"
                    style="text-align:left;">
                    <h6>Kaydet</h6>
                </div>
                <div class="container-fluid d-flex flex-column justify-content-center align-items-center gap-5">
                    <div class="input w-100 d-flex flex-column">
                        <label for="password" class="form-label">Şifre</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="input w-100 d-flex flex-column">
                        <label for="passwordagain" class="form-label">Şifre Tekrar</label>
                        <input type="password" name="passwordagain" class="form-control">
                    </div>
                    <?php if(isset($_COOKIE["error"])){ echo "<label>".$_COOKIE["error"] ."</label>";}?>
                    <div class="input w-100">
                        <button type="submit" name="profilebtn" class="btn btn-warning w-100 text-light">Güncelle</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>