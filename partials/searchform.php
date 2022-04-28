<form action="" method="get">
    <div class="input-group col-10 col-sm-8 col-md-6 mx-auto my-auto">
        <input type="text" name="search" class="form-control" placeholder="<?= $page == 'donors_public.php'?'Search Name, Donation Details, Area Or City..':'Search...' ?>"
            value="<?= $_GET['search'] ?? "" ?>">
        <div class="input-group-append">
            <button class="input-group-text" id="basic-addon2"><i class="mdi mdi-account-search"></i></button>
        </div>
    </div>
</form>