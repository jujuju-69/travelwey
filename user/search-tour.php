<form action="sresult-tour.php" method="GET" class="search-property-1">
    <div class="row no-gutters">
        <div class="col-md d-flex">
            <div class="form-group p-4 border-0">
                <label for="destination">Destination</label>
                <div class="form-field">
                    <div class="icon"><span class="fa fa-search"></span></div>
                    <input type="text" class="form-control" id="destination" placeholder="Search place" name="name">
                </div>
            </div>
        </div>
        <div class="col-md d-flex">
            <div class="form-group p-4">
                <label for="location">State</label>
                <div class="form-field">
                    <div class="select-wrap">
                        <div class="icon"><span class="fa fa-chevron-down"></span></div>
                        <select name="location" id="location" class="form-control">
                        <option value="">Select States</option>
                        <option value="Johor">Johor</option>
                        <option value="Kedah">Kedah</option>
                        <option value="Kelantan">Kelantan</option>
                        <option value="Melaka">Melaka</option>
                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                        <option value="Pahang">Pahang</option>
                        <option value="Penang">Penang</option>
                        <option value="Perak">Perak</option>
                        <option value="Perlis">Perlis</option>
                        <option value="Sabah">Sabah</option>
                        <option value="Sarawak">Sarawak</option>
                        <option value="Selangor">Selangor</option>
                        <option value="Terengganu">Terengganu</option>  
                </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md d-flex">
            <div class="form-group d-flex w-100 border-0">
                <div class="form-field w-100 align-items-center d-flex">
                    <input type="submit" value="Search" class="align-self-stretch form-control btn btn-primary">
                </div>
            </div>
        </div>
    </div>
</form>
