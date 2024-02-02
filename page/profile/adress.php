<div class="container p-5">
    <div class="row px-5 d-flex flex-column ">
        <div class="accordion accordion-flush mb-3 " >
            <div class="accordion-item border-1 border-bottom border-warning ">
                <h2 class="accordion-header ">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Adress Ekle
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse " data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate
                        the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                </div>
            </div>
        </div>

        <div class="container-fluid d-flex flex-rows gap-2">
        <?php 
        $result = $database->getAdress("useradress",$usrid);
        while($rows= mysqli_fetch_assoc($result))
        {?>

        <div class="card p-0 border-1 border-secondary" style="max-width: 300px;text-align:left; min-height: 250px;">
            <div class="card-title d-flex align-items-center px-3 pt-2 pb-1 border-1 border-bottom border-secondary"
                style="font-size: 14px;">
                <?php echo $rows["AdressName"]; ?>
            </div>
            <div class="card-body p-0 px-2">
                <div class="card-text px-2" style="font-size: 12px;">
                    <?php echo ucfirst($rows["Name"]) . "  ". strtoupper($rows["Surname"]) ?>
                </div>
                <div class="card-text px-2 pt-3">
                    <?php echo $rows["Adress"] ?>
                </div>
                <div class="card-text px-2 py-2">
                    <?php echo $rows["Tel"] ?>
                </div>
                <div class="card-text px-2">
                    <?php echo $rows["postCode"] ?>
                </div>
                <div class="input pt-4 d-flex px-2 justify-content-between align-items-center">
                    <button type="submit" class="btn d-flex align-items-center"
                        style="font-size: 14px; font-weight:600;">
                        <span class="material-symbols-outlined ">
                            delete
                        </span>
                        Sil
                    </button>
                    <button type="submit" class="btn border-1 border-warning addressbtn">Düzenle</button>
                </div>
            </div>

        </div>

        <?php }
        
        ?>
        </div>
    </div>
</div>