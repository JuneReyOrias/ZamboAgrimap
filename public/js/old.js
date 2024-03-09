let map; // Declare the map variable to make it accessible globally
let markers = []; // Global array to track markers
let polygons = []; // Global array to track markers
let infoWindows = []; // Global array to track info windows
let parcels = []; // Global array to track markers
function initMap() {
    // Create LatLng objects for different locations
    let map; // Global map variable
    let markers = []; // Global array to track markers


    // ... (your existing initMap code)

    // Get the file input element
    const fileInput = document.getElementById('fileInput');

    // Listen for changes in the file input
    fileInput.addEventListener('change', handleFileUpload);


    function handleFileUpload() {
        const fileInput = document.getElementById('fileInput');
        const file = fileInput.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const fileContent = e.target.result;

                // Check if the file is KML or KMZ
                if (file.name.toLowerCase().endsWith('.kml')) {
                    displayKML(fileContent);
                } else if (file.name.toLowerCase().endsWith('.kmz')) {
                    displayKMZ(fileContent);
                } else {
                    console.error('Unsupported file format');
                }
            };

            reader.readAsText(file);
        }
    }

    // Function to display KML data on the map
    function displayKML(kmlData) {
        // ... (your existing displayKML code)
    }

    // Function to display KMZ data on the map
    function displayKMZ(kmzData) {
        // ... (your existing displayKMZ code)
    }

    class farmprofiles {
        constructor(latitude, longitude, district, description) {

            this.latitude = latitude;
            this.longitude = longitude;
            this.district = district;
            this.description = description;

        }
    }

    const listOfprofiles = []

    const datadistricts = document.querySelectorAll('.newdistrict')
    datadistricts.forEach((location, index) => {
        let lat = location.getAttribute("data-lat")
        let long = location.getAttribute("data-lng")
        let loc = location.getAttribute("data-location")
        let description = location.getAttribute("data-description")
        listOfprofiles.push(new farmprofiles(parseFloat(lat), parseFloat(long), loc, description));
    })

    //farmers locations
    class farmdistricts {
        constructor(latitude, longitude, district, gps_latitude, gps_longitude, last_name, mothers_maiden_name,
            home_address, nameof_farmers_ass_org_coops, tenurial_status, no_of_years_as_farmers, land_title_no,
            lot_no, area_prone_to, ecosystem, type_rice_variety, prefered_variety, plant_schedule_wetseason,
            plant_schedule_dryseason, no_of_cropping_yr, yield_kg_ha, source_of_capital, rsba_register,
            pcic_insured, government_assisted, sex, total_physical_area_has, rice_area_cultivated_has, description, ) {
            this.latitude = latitude;
            this.longitude = longitude;
            this.location_name = district;
            this.gps_latitude = gps_latitude;
            this.gps_longitude = gps_longitude;
            this.last_name = last_name;
            this.mothers_maiden_name = mothers_maiden_name;
            this.home_address = home_address;
            this.nameof_farmers_ass_org_coops = nameof_farmers_ass_org_coops;
            this.tenurial_status = tenurial_status;
            this.no_of_years_as_farmers = no_of_years_as_farmers;
            this.land_title_no = land_title_no;
            this.lot_no = lot_no;
            this.area_prone_to = area_prone_to;
            this.ecosystem = ecosystem;
            this.type_rice_variety = type_rice_variety;
            this.prefered_variety = prefered_variety;
            this.plant_schedule_wetseason = plant_schedule_wetseason;
            this.plant_schedule_dryseason = plant_schedule_dryseason;
            this.no_of_cropping_yr = no_of_cropping_yr;
            this.yield_kg_ha = yield_kg_ha;
            this.source_of_capital = source_of_capital;
            this.rsba_register = rsba_register;
            this.pcic_insured = pcic_insured;
            this.government_assisted = government_assisted;
            this.sex = sex;
            this.total_physical_area_has = total_physical_area_has;
            this.rice_area_cultivated_has = rice_area_cultivated_has;
            this.description = description;





        }
    }

    const listOfFarm = []
        //farmloactions
    const dataLocation = document.querySelectorAll(".test")
    dataLocation.forEach((location, index) => {
        let lat = location.getAttribute("data-lat")
        let long = location.getAttribute("data-lng")
        let loc = location.getAttribute("data-location")
        let last = location.getAttribute("data-lastname")
        let farm_lat = location.getAttribute("data-farms_lat")
        let farm_long = location.getAttribute("data-farms_lng")
        let mother = location.getAttribute("data-mothers")
        let address = location.getAttribute("data-address")
        let farm_org = location.getAttribute("data-farm_org")
        let status = location.getAttribute("data-status")
        let years = location.getAttribute("data-years")
        let landtitle = location.getAttribute("data-landtitle")
        let lotno = location.getAttribute("data-lotno")
        let areaprone = location.getAttribute("data-areaprone")
        let ecosystem = location.getAttribute("data-ecosystem")
        let typevariety = location.getAttribute("data-typevariety")
        let prefered = location.getAttribute("data-prefered")
        let wetseason = location.getAttribute("data-wetseason")
        let dryseason = location.getAttribute("data-dryseason")
        let cropping = location.getAttribute("data-cropping")
        let yieldha = location.getAttribute("data-yieldha")
        let capital = location.getAttribute("data-capital")
        let description = location.getAttribute("data-description")

        let rsba = location.getAttribute("data-rsba")
        let pcic = location.getAttribute("data-pcic")
        let assisted = location.getAttribute("data-assisted")
        let sex = location.getAttribute("data-sex")
        let area_has = location.getAttribute("data-area_has")
        let cultivated_has = location.getAttribute("data-cultivated_has")
        listOfFarm.push(new farmdistricts(parseFloat(lat), parseFloat(long), loc, parseFloat(farm_lat), parseFloat(farm_long), last, mother, address,
            farm_org, status, parseFloat(years), landtitle, lotno, areaprone, ecosystem, typevariety,
            prefered, wetseason, dryseason, cropping, yieldha, capital, rsba, pcic, assisted, sex, area_has, cultivated_has, description));
    })

    //polygons
    class districtPolygon {
        constructor(verone_latitude, verone_longitude, vertwo_latitude, vertwo_longitude, verthree_latitude, verthree_longitude,
            vertfour_latitude, vertfour_longitude, verfive_latitude, verfive_longitude, versix_latitude,
            versix_longitude, verseven_latitude, verseven_longitude, vereight_latitude, verteight_longitude,
            strokecolor, area, perimeter, poly_name) {
            this.verone_latitude = verone_latitude;
            this.verone_longitude = verone_longitude;
            this.vertwo_latitude = vertwo_latitude;
            this.vertwo_longitude = vertwo_longitude;
            this.verthree_latitude = verthree_latitude;
            this.verthree_longitude = verthree_longitude;
            this.vertfour_latitude = vertfour_latitude;
            this.vertfour_longitude = vertfour_longitude;
            this.verfive_latitude = verfive_latitude;
            this.verfive_longitude = verfive_longitude;
            this.versix_latitude = versix_latitude;
            this.versix_longitude = versix_longitude;
            this.verseven_latitude = verseven_latitude;
            this.verseven_longitude = verseven_longitude;
            this.vereight_latitude = vereight_latitude;
            this.verteight_longitude = verteight_longitude;
            this.strokecolor = strokecolor;
            this.area = area;
            this.perimeter = perimeter;
            this.poly_name = poly_name;
        }
    }

    const listOfPolygon = []

    const dataBoundary = document.querySelectorAll(".newpolygo")
    dataBoundary.forEach((location, index) => {
        let verone_lat = location.getAttribute("data-verone_lat")
        let verone_long = location.getAttribute("data-verone_lng")
        let vertwo_lat = location.getAttribute("data-vertwo_lat")
        let vertwo_long = location.getAttribute("data-vertwo_lng")
        let verthree_lat = location.getAttribute("data-verthree_lat")
        let verthree_long = location.getAttribute("data-verthree_lng")
        let vertfour_lat = location.getAttribute("data-vertfour_lat")
        let vertfour_long = location.getAttribute("data-vertfour_lng")
        let verfive_lat = location.getAttribute("data-verfive_lat")
        let verfive_long = location.getAttribute("data-verfive_lng")
        let versix_lat = location.getAttribute("data-versix_lat")
        let versix_long = location.getAttribute("data-versix_lng")
        let verseven_lat = location.getAttribute("data-verseven_lat")
        let verseven_long = location.getAttribute("data-verseven_lng")
        let vereight_lat = location.getAttribute("data-vereight_lat")
        let verteight_long = location.getAttribute("data-verteight_lng")
        let color = location.getAttribute("data-color")
        let area = location.getAttribute("data-area")
        let perimeter = location.getAttribute("data-perimeter")
        let polyname = location.getAttribute("data-polyname")
        listOfPolygon.push(new districtPolygon(parseFloat(verone_lat), parseFloat(verone_long),
            parseFloat(vertwo_lat), parseFloat(vertwo_long), parseFloat(verthree_lat), parseFloat(verthree_long),
            parseFloat(vertfour_lat), parseFloat(vertfour_long), parseFloat(verfive_lat), parseFloat(verfive_long),
            parseFloat(versix_lat), parseFloat(versix_long), parseFloat(verseven_lat), parseFloat(verseven_long),
            parseFloat(vereight_lat), parseFloat(verteight_long), color, area, perimeter, polyname
        ));
    })

    //parcels
    class parcelboarders {
        constructor(parone_latitude, parone_longitude, partwo_latitude, partwo_longitude, parthree_latitude, parthree_longitude,
            parfour_latitude, parfour_longitude, parfive_latitude, parfive_longitude, parsix_latitude,
            parsix_longitude, parseven_latitude, parseven_longitude, pareight_latitude, pareight_longitude,
            parnine_latitude, parnine_longitude, parten_latitude, parten_longitude,
            pareleven_latitude, pareleven_longitude, partwelve_latitude, partwelve_longitude, parcolor, parcel_name,
            arpowner_na, brgy_name, lot_no, pkind_desc, puse_desc, actual_used, tct_no) {
            this.parone_latitude = parone_latitude;
            this.parone_longitude = parone_longitude;
            this.partwo_latitude = partwo_latitude;
            this.partwo_longitude = partwo_longitude;
            this.parthree_latitude = parthree_latitude;
            this.parthree_longitude = parthree_longitude;
            this.parfour_latitude = parfour_latitude;
            this.parfour_longitude = parfour_longitude;
            this.parfive_latitude = parfive_latitude;
            this.parfive_longitude = parfive_longitude;
            this.parsix_latitude = parsix_latitude;
            this.parsix_longitude = parsix_longitude;
            this.parseven_latitude = parseven_latitude;
            this.parseven_longitude = parseven_longitude;
            this.pareight_latitude = pareight_latitude;
            this.pareight_longitude = pareight_longitude;
            this.parnine_latitude = parnine_latitude;
            this.parnine_longitude = parnine_longitude;
            this.parten_latitude = parten_latitude;

            this.parten_longitude = parten_longitude;
            this.pareleven_latitude = pareleven_latitude;
            this.pareleven_longitude = pareleven_longitude;
            this.partwelve_latitude = partwelve_latitude;
            this.partwelve_longitude = partwelve_longitude;
            this.parcolor = parcolor;
            this.parcel_name = parcel_name;
            this.arpowner_na = arpowner_na;
            this.brgy_name = brgy_name;
            this.lot_no = lot_no;
            this.pkind_desc = pkind_desc;
            this.puse_desc = puse_desc;
            this.actual_used = actual_used;
            this.tct_no = tct_no;
        }
    }

    const listOfParcels = []

    const dataParcel = document.querySelectorAll(".newparcel")
    dataParcel.forEach((parcel, index) => {
        let paronelat = parcel.getAttribute("data-paronelat")
        let paronelong = parcel.getAttribute("data-paronelong")
        let partwolat = parcel.getAttribute("data-partwolat")
        let partwolong = parcel.getAttribute("data-partwolong")
        let parthreelat = parcel.getAttribute("data-parthreelat")
        let parthreelong = parcel.getAttribute("data-parthreelong")
        let parfourlat = parcel.getAttribute("data-parfourlat")
        let parfourlong = parcel.getAttribute("data-parfourlong")
        let parfivelat = parcel.getAttribute("data-parfivelat")
        let parfivelong = parcel.getAttribute("data-parfivelong")
        let parsixlat = parcel.getAttribute("data-parsixlat")
        let parsixlong = parcel.getAttribute("data-parsixlong")
        let parsevenlat = parcel.getAttribute("data-parsevenlat")
        let parsevenlong = parcel.getAttribute("data-parsevenlong")
        let pareightlat = parcel.getAttribute("data-pareightlat")
        let pareightlong = parcel.getAttribute("data-pareightlong")

        let parninelat = parcel.getAttribute("data-parninelat")
        let parninelong = parcel.getAttribute("data-parninelong")
        let partenlat = parcel.getAttribute("data-partenlat")
        let partenlong = parcel.getAttribute("data-partenlong")
        let parelevenlat = parcel.getAttribute("data-parelevenlat")
        let parelevenlong = parcel.getAttribute("data-parelevenlong")
        let paronetwelvelat = parcel.getAttribute("data-paronetwelvelat")
        let partwelvelong = parcel.getAttribute("data-pareightlong")


        let parcolors = parcel.getAttribute("data-parcolors")
        let parname = parcel.getAttribute("data-parname")
        let arpowner_na = parcel.getAttribute("data-arpowner_na")
        let brgy_name = parcel.getAttribute("data-brgy_name")
        let lot_no = parcel.getAttribute("data-lot_no")
        let pkind_desc = parcel.getAttribute("data-pkind_desc")
        let puse_desc = parcel.getAttribute("data-puse_desc")
        let actual_used = parcel.getAttribute("data-actual_used")
        let tct_no = parcel.getAttribute("data-tct_no")
        listOfParcels.push(new parcelboarders(parseFloat(paronelat), parseFloat(paronelong),
            parseFloat(partwolat), parseFloat(partwolong), parseFloat(parthreelat), parseFloat(parthreelong),
            parseFloat(parfourlat), parseFloat(parfourlong), parseFloat(parfivelat), parseFloat(parfivelong),
            parseFloat(parsixlat), parseFloat(parsixlong), parseFloat(parsevenlat), parseFloat(parsevenlong),
            parseFloat(pareightlat), parseFloat(pareightlong), parseFloat(parninelat), parseFloat(parninelong),
            parseFloat(partenlat), parseFloat(partenlong), parseFloat(parelevenlat), parseFloat(parelevenlong),
            parseFloat(paronetwelvelat), parseFloat(partwelvelong), parcolors, parname, arpowner_na, brgy_name, lot_no, pkind_desc,
            puse_desc, actual_used, tct_no
        ));
    })
    const locationZC = { lat: 6.9214, lng: 122.0790 }; // ZAMBOANGA CITY LATLANG

    // Options for the map
    const mapOptions = {
        center: locationZC,
        zoom: 10
    };

    // Create the map instance
    map = new google.maps.Map(document.getElementById('map'), mapOptions);

    //Districts informations info window
    function districtContent(profiles) {
        const userRole = getCurrentUserRole();
        let editButton = '';

        if (userRole === 'agent' || userRole === 'admin') {
            editButton = `<button onclick="editFarm(${profiles.id})" style="margin-top: 10px; padding: 8px 12px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">Edit</button>`;
        }
        return `
        <div style="font-family: Arial, sans-serif; color: #333; background-color: #fff; padding: 10px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">

        <h4 style="margin-bottom: 10px;Align-tex:center;">Agri-District</h4>
        <table style="width:100%; border-collapse: collapse;">
        <tr style="background-color: #c6e2ff;">
            <td style="padding: 8px;"><strong>District Name:</strong></td>
            <td style="padding: 8px;">${profiles.district}</td>
        </tr>
        <tr style="background-color:#eaf7fa;">
            <td style="padding: 8px; "><strong>Description:</strong></td>
            <td style="padding: 8px;">${profiles.description}</td>
        </tr>
        <tr style="background-color: #c6e2ff;">
        <td style="padding: 8px;"><strong>Location:</strong></td>
        <td style="padding: 8px;">${profiles.latitude}</td>
    </tr>
    <tr style="background-color:#eaf7fa;">
    <td style="padding: 8px; "><strong>Location :</strong></td>
    <td style="padding: 8px;">${profiles.longitude}</td>
</tr>
    </table>
    ${editButton} 
    </div>
        `;
    }

    //Farmers demographic informations functions info window
    function getCurrentUserRole() {
        // Implement logic to fetch the current user's role from your authentication system
        // For this example, I'm just returning a hardcoded role
        return 'agent'; // or 'admin', 'user', etc.
    }

    function generateInfoWindowContent(farm) {
        const userRole = getCurrentUserRole();
        let editButton = '';

        if (userRole === 'agent' || userRole === 'admin') {
            editButton = `<button onclick="editFarm(${farm.id})" style="margin-top: 10px; padding: 8px 12px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">Edit</button>`;
        }
        return `
        <div style="font-family: Arial, sans-serif; color: #333; background-color: #fff; padding: 10px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">

        <h4 style="margin-bottom: 10px;Align-tex:center;">Farmer Informations</h4>
        <table style="width:100%; border-collapse: collapse;">
        <tr style="background-color: #c6e2ff;">
            <td style="padding: 8px;"><strong>FullName:</strong></td>
            <td style="padding: 8px;">${farm.last_name}</td>
        </tr>
        <tr style="background-color:#eaf7fa;">
            <td style="padding: 8px; "><strong>Mother's Maiden Name:</strong></td>
            <td style="padding: 8px;">${farm.mothers_maiden_name}</td>
        </tr>
        <tr style="background-color: #c6e2ff;">
        <td style="padding: 8px;"><strong>Sex:</strong></td>
        <td style="padding: 8px;">${farm.sex}</td>
    </tr>
        <tr style="background-color: #eaf7fa;">
            <td style="padding: 8px;"><strong>Home Address:</strong></td>
            <td style="padding: 8px;">${farm.home_address}</td>
        </tr>
        <tr style="background-color:#c6e2ff;">
            <td style="padding: 8px;"><strong>Tenurial Status:</strong></td>
            <td style="padding: 8px;">${farm.tenurial_status}</td>
        </tr >
        <tr style="background-color: #eaf7fa;">
            <td style="padding: 8px; "><strong>No. of Years as farmers:</strong></td>
            <td style="padding: 8px;">${farm.no_of_years_as_farmers}</td>
        </tr>
        <tr style="background-color: #c6e2ff;">
            <td style="padding: 8px;"><strong>GPS Latitude:</strong></td>
            <td style="padding: 8px;">${farm.gps_latitude ? farm.gps_latitude : farm.latitude}</td>
        </tr >
        <tr style="background-color: #eaf7fa;">
            <td style="padding: 8px; "><strong>GPS Longitude:</strong></td>
            <td style="padding: 8px;">${farm.gps_longitude ? farm.gps_longitude : farm.longitude}</td>
        </tr>
        <tr style="background-color: #c6e2ff;">
        <td style="padding: 8px;"><strong>Land Title No.:</strong></td>
        <td style="padding: 8px;">${farm.land_title_no}</td>
        </tr>
        <tr style="background-color: #eaf7fa;">
            <td style="padding: 8px;"><strong>Land No.:</strong></td>
            <td style="padding: 8px;">${farm.lot_no}</td>
        </tr >
        <tr style="background-color:#c6e2ff;">
        <td style="padding: 8px;"><strong> Area Prone to:</strong></td>
        <td style="padding: 8px;">${farm.area_prone_to}</td>
        </tr>
        <tr style="background-color: #eaf7fa;">
            <td style="padding: 8px;"><strong>Ecosystem:</strong></td>
            <td style="padding: 8px;">${farm.ecosystem}</td>
        </tr >
        <tr style="background-color:#c6e2ff;">
        <td style="padding: 8px;"><strong> Type of Rice Variety:</strong></td>
        <td style="padding: 8px;">${farm.type_rice_variety}</td>
        </tr>
        <tr style="background-color: #eaf7fa;">
            <td style="padding: 8px;"><strong>Preferred Variety:</strong></td>
            <td style="padding: 8px;">${farm.prefered_variety}</td>
        </tr >
        <tr style="background-color: #c6e2ff;">
        <td style="padding: 8px;"><strong>Plant Schedule(wetseason):</strong></td>
        <td style="padding: 8px;">${farm.plant_schedule_wetseason}</td>
        </tr>
        <tr style="background-color: #eaf7fa;">
            <td style="padding: 8px;"><strong> Plant Schedule(dryseason):</strong></td>
            <td style="padding: 8px;">${farm.plant_schedule_dryseason}</td>
        </tr >
        <tr style="background-color: #c6e2ff;">
        <td style="padding: 8px;"><strong> No. Cropping/yr:</strong></td>
        <td style="padding: 8px;">${farm.no_of_cropping_yr}</td>
        </tr>
        <tr style="background-color: #eaf7fa;">
            <td style="padding: 8px;"><strong>  Yield (kg/has):</strong></td>
            <td style="padding: 8px;">${farm.yield_kg_ha}</td>
        </tr >
        <tr style="background-color: #c6e2ff;">
        <td style="padding: 8px;"><strong>RSBA Registered:</strong></td>
        <td style="padding: 8px;">${farm.rsba_register}</td>
        </tr>
        <tr style="background-color: #eaf7fa;">
        <td style="padding: 8px;"><strong> PCIC Insured:</strong></td>
        <td style="padding: 8px;">${farm.pcic_insured}</td>
        </tr >
        <tr style="background-color: #c6e2ff;">
        <td style="padding: 8px;"><strong>Gov. Assisted:</strong></td>
        <td style="padding: 8px;">${farm.government_assisted}</td>
        </tr>

        <tr style="background-color: #eaf7fa;">
        <td style="padding: 8px;"><strong>Total Physical Area(Has):</strong></td>
        <td style="padding: 8px;">${farm.total_physical_area_has}</td>
        </tr >
        <tr style="background-color: #c6e2ff;">
        <td style="padding: 8px;"><strong>Rice Cultivated Area(Has):</strong></td>
        <td style="padding: 8px;">${farm.rice_area_cultivated_has}</td>
        </tr>
    </table>
    ${editButton} 
    </div>
        `;
    }

    //Districts informations info window
    function PolygonInfo(polygon) {

        const userRole = getCurrentUserRole();
        let editButton = '';

        if (userRole === 'agent' || userRole === 'admin') {
            editButton = `<button onclick="editFarm(${polygon.id})" style="margin-top: 10px; padding: 8px 12px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">Edit</button>`;
        }
        return `
        <div style="font-family: Arial, sans-serif; color: #333; background-color: #fff; padding: 10px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">

        <h4 style="margin-bottom: 10px;Align-tex:center;">Polygons</h4>
        <table style="width:100%; border-collapse: collapse;">
                <tr style="background-color: #c6e2ff;">
                    <td style="padding: 8px;"><strong>PolyName:</strong></td>
                    <td style="padding: 8px;">${polygon.poly_name}</td>
                </tr>
                <tr style="background-color:#eaf7fa;">
                    <td style="padding: 8px; "><strong>Area:</strong></td>
                    <td style="padding: 8px;">${polygon.area}</td>
                </tr>
                <tr style="background-color: #c6e2ff;">
                <td style="padding: 8px;"><strong>Perimeter:</strong></td>
                <td style="padding: 8px;">${polygon.perimeter}</td>
                
    </table>
    ${editButton} 
    </div>
        `;
    }

    //Parcels informations info window
    function ParcelInfo(parcelary) {
        const userRole = getCurrentUserRole();
        let editButton = '';

        if (userRole === 'agent' || userRole === 'admin') {
            editButton = `<button onclick="editFarm(${parcelary.id})" style="margin-top: 10px; padding: 8px 12px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">Edit</button>`;
        }
        return `
        <div style="font-family: Arial, sans-serif; color: #333; background-color: #fff; padding: 10px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">

        <h4 style="margin-bottom: 10px;Align-tex:center;">Parcel Boarders</h4>
        <table style="width:100%; border-collapse: collapse;">
                <tr style="background-color: #c6e2ff;">
                    <td style="padding: 8px;"><strong>ParcelName:</strong></td>
                    <td style="padding: 8px;">${parcelary.parcel_name}</td>
                </tr>
                <tr style="background-color:#eaf7fa;">
                    <td style="padding: 8px; "><strong>ARPOwner Name:</strong></td>
                    <td style="padding: 8px;">${parcelary.arpowner_na}</td>
                </tr>
                <tr style="background-color: #c6e2ff;">
                <td style="padding: 8px;"><strong>Brgy. Name:</strong></td>
                <td style="padding: 8px;">${parcelary.brgy_name}</td>
                </tr>
                <tr style="background-color:#eaf7fa;">
                <td style="padding: 8px; "><strong>Land Title no.:</strong></td>
                <td style="padding: 8px;">${parcelary.tct_no}</td>
            </tr>
            <tr style="background-color: #c6e2ff;">
            <td style="padding: 8px;"><strong>Lot No.:</strong></td>
            <td style="padding: 8px;">${parcelary.lot_no}</td>
            </tr>
                <tr style="background-color: #eaf7fa;">
                <td style="padding: 8px;"><strong>Pkind Desc:</strong></td>
                <td style="padding: 8px;">${parcelary.pkind_desc}</td>
                </tr>
                <tr style="background-color:#c6e2ff;">
                <td style="padding: 8px; "><strong>Pused Desc:</strong></td>
                <td style="padding: 8px;">${parcelary.puse_desc}</td>
                </tr>
                <tr style="background-color:#eaf7fa;">
                <td style="padding: 8px;"><strong>Actual Used:</strong></td>
                <td style="padding: 8px;">${parcelary.actual_used}</td>
                </tr>
               
    </table>
    ${editButton} 
    </div>
        `;
    }
    // Access the KML file name from the global window object

    // Add this code for the KML layer (if needed)
    const kmlLayer = new google.maps.KmlLayer({
        url: `/storage/kml_folder/{{ $fileName }}`,
        map: map,
        preserveViewport: true
    });
    // URL image of markers pin
    const imagefarmers = "../assets/images/mappin.png";
    //farmers pin locations
    listOfFarm.forEach(farm => {

        const positions = {
            lat: farm.gps_latitude,
            lng: farm.gps_longitude,

        };

        const marker = new google.maps.Marker({
            position: positions,
            map: map,
            // title: farm.location_name,
            icon: {
                url: imagefarmers, // Use the image URL as the marker icon
                scaledSize: new google.maps.Size(30, 30), // Adjust the size as needed
            },

        });

        const infoWindowContent = generateInfoWindowContent(farm);

        const infoWindow = new google.maps.InfoWindow({
            content: infoWindowContent,
        });

        marker.addListener('click', function() {
            // Close all other open info windows
            infoWindows.forEach(info => info.close());

            // Open the current info window
            infoWindow.open(map, marker);

            // Add the current info window to the global array
            infoWindows.push(infoWindow);
        });

        markers.push(marker); // Add the marker to the global array
    });

    const imagedistrict = "../assets/images/district.png";
    //profiles of districts 
    listOfprofiles.forEach(profiles => {
        console.log(profiles.latitude)
        console.log(profiles.longitude)

        const position = {
            lat: profiles.latitude,
            lng: profiles.longitude,



        };

        const marker = new google.maps.Marker({
            position: position,
            map: map,
            title: profiles.district,
            icon: {
                url: imagedistrict, // Use the image URL as the marker icon
                scaledSize: new google.maps.Size(40, 40), // Adjust the size as needed
            },
        });

        const infoWindowContent = districtContent(profiles);



        const infoWindow = new google.maps.InfoWindow({
            content: infoWindowContent,
        });

        marker.addListener('click', function() {
            // Close all other open info windows
            infoWindows.forEach(info => info.close());

            // Open the current info window
            infoWindow.open(map, marker);

            // Add the current info window to the global array
            infoWindows.push(infoWindow);
        });

        markers.push(marker); // Add the marker to the global array
    });

    // Polygons points using lat lang  to create a districts boundary
    listOfPolygon.forEach(polygon => {
        console.log(polygon.verone_latitude)
        console.log(polygon.verone_longitude)
        console.log(polygon.vertwo_latitude)
        console.log(polygon.vertwo_longitude)
        console.log(polygon.verthree_latitude)
        console.log(polygon.verthree_longitude)
        console.log(polygon.vertfour_latitude)
        console.log(polygon.vertfour_longitude)
        console.log(polygon.verfive_latitude)
        console.log(polygon.verfive_longitude)
        console.log(polygon.versix_latitude)
        console.log(polygon.versix_longitude)
        console.log(polygon.verseven_latitude)
        console.log(polygon.verseven_longitude)
        console.log(polygon.vereight_latitude)
        console.log(polygon.verteight_longitude)
        console.log(polygon.strokecolor)


        //coordinates of per points using lang
        const permDistrictCoordinates = [
            { lat: polygon.verone_latitude, lng: polygon.verone_longitude }, // point latlang 1
            { lat: polygon.vertwo_latitude, lng: polygon.vertwo_longitude }, // point latlang 2
            { lat: polygon.verthree_latitude, lng: polygon.verthree_longitude }, // point latlang 3
            { lat: polygon.vertfour_latitude, lng: polygon.vertfour_longitude }, // point latlang 4
            { lat: polygon.verfive_latitude, lng: polygon.verfive_longitude }, // point latlang 5
            { lat: polygon.versix_latitude, lng: polygon.versix_longitude }, // point latlang 6
            { lat: polygon.verseven_latitude, lng: polygon.verseven_longitude }, // point latlang 7
            { lat: polygon.vereight_latitude, lng: polygon.verteight_longitude }, // point latlang 8

        ];


        //polygons fetcing of for each data from databases then display it in the map
        const permDistrictPolygon = new google.maps.Polygon({
            paths: permDistrictCoordinates,
            strokeColor: polygon.strokecolor,
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: 'transparent', // Set fillColor to transparent
            fillOpacity: 0.1 // Set fillOpacity to 0 for transparency
        });
        permDistrictPolygon.setMap(map);


        const infoWindowContent = PolygonInfo(polygon);

        const infoWindow = new google.maps.InfoWindow({
            content: infoWindowContent,
        });

        permDistrictPolygon.addListener('click', function(event) {
            // Close all other open info windows
            infoWindows.forEach(info => info.close());

            // Set the position of the InfoWindow to the clicked position
            infoWindow.setPosition(event.latLng);

            // Open the current info window
            infoWindow.open(map);

            // Add the current info window to the global array
            infoWindows.push(infoWindow);
        });

        polygons.push(permDistrictPolygon);

    });

    // ParcelBoarder points using lat lang  to create a districts boundary
    listOfParcels.forEach(parcelary => {
        console.log(parcelary.parone_latitude)
        console.log(parcelary.parone_longitude)
        console.log(parcelary.partwo_latitude)
        console.log(parcelary.partwo_longitude)
        console.log(parcelary.parthree_latitude)
        console.log(parcelary.parthree_longitude)
        console.log(parcelary.parfour_latitude)
        console.log(parcelary.parfour_longitude)
        console.log(parcelary.parfive_latitude)
        console.log(parcelary.parfive_longitude)
        console.log(parcelary.parsix_latitude)
        console.log(parcelary.parsix_longitude)
        console.log(parcelary.parseven_latitude)
        console.log(parcelary.parseven_longitude)
        console.log(parcelary.pareight_latitude)
        console.log(parcelary.pareight_longitude)
        console.log(parcelary.parnine_latitude)
        console.log(parcelary.parnine_longitude)
        console.log(parcelary.parten_latitude)
        console.log(parcelary.parten_longitude)
        console.log(parcelary.pareleven_latitude)
        console.log(parcelary.pareleven_longitude)
        console.log(parcelary.partwelve_latitude)
        console.log(parcelary.partwelve_longitude)
        console.log(parcelary.parcolor)



        //coordinates of per points using lang
        const permParcelCoordinates = [
            { lat: parcelary.parone_latitude, lng: parcelary.parone_longitude }, // point latlang 1
            { lat: parcelary.partwo_latitude, lng: parcelary.partwo_longitude }, // point latlang 2
            { lat: parcelary.parthree_latitude, lng: parcelary.parthree_longitude }, // point latlang 3
            { lat: parcelary.parfour_latitude, lng: parcelary.parfour_longitude }, // point latlang 4
            { lat: parcelary.parfive_latitude, lng: parcelary.parfive_longitude }, // point latlang 5
            { lat: parcelary.parsix_latitude, lng: parcelary.parsix_longitude }, // point latlang 6
            { lat: parcelary.parseven_latitude, lng: parcelary.parseven_longitude }, // point latlang 7
            { lat: parcelary.pareight_latitude, lng: parcelary.pareight_longitude }, // point latlang 8
            { lat: parcelary.parnine_latitude, lng: parcelary.parnine_longitude }, // point latlang 3
            { lat: parcelary.parten_latitude, lng: parcelary.parten_longitude }, // point latlang 4
            { lat: parcelary.pareleven_latitude, lng: parcelary.pareleven_longitude }, // point latlang 5
            { lat: parcelary.partwelve_latitude, lng: parcelary.partwelve_longitude }, // point latlang 6

        ];


        //polygons fetcing of for each data from databases then display it in the map
        const permDistrictParcel = new google.maps.Polygon({
            paths: permParcelCoordinates,
            strokeColor: parcelary.parcolor,
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: 'transparent', // Set fillColor to transparent
            fillOpacity: 0.1 // Set fillOpacity to 0 for transparency
        });
        permDistrictParcel.setMap(map);


        const infoWindowContent = ParcelInfo(parcelary);

        const infoWindow = new google.maps.InfoWindow({
            content: infoWindowContent,
        });

        permDistrictParcel.addListener('click', function(event) {
            // Close all other open info windows
            infoWindows.forEach(info => info.close());

            // Set the position of the InfoWindow to the clicked position
            infoWindow.setPosition(event.latLng);

            // Open the current info window
            infoWindow.open(map);

            // Add the current info window to the global array
            infoWindows.push(infoWindow);
        });

        parcels.push(permDistrictParcel);

    });

    // const kmlLayer = new google.maps.KmlLayer({
    //     url: `/storage/kml_folder/{{ $fileName }}`,
    //     map: map,
    // });
    // // Create the Perm District polygon
    // const permDistrictPolygon = new google.maps.Polygon({
    //     paths: permDistrictCoordinates,
    //     strokeColor: '#fff',
    //     strokeOpacity: 0.8,
    //     strokeWeight: 2,
    //     fillColor: '#FF0000',
    //     fillOpacity: 0.35
    // });
    // permDistrictPolygon.setMap(map);
    // const infoWindow = new google.maps.InfoWindow({
    //     content: `<div><strong>${farm.location_name}</strong></div>`,
    // });
    // permDistrictPolygon.setMap(map);
    // // Add a click event listener to open the info window when the marker is clicked
    // marker.addListener('click', function() {
    //     infoWindow.open(map, marker);
    // });
    // // Create the map instance
    // map = new google.maps.Map(document.getElementById('map'), mapOptions);

    // // Initialize the drawing manager
    // drawingManager = new google.maps.drawing.DrawingManager({
    //     drawingMode: null,
    //     drawingControl: true,
    //     drawingControlOptions: {
    //         position: google.maps.ControlPosition.TOP_LEFT,
    //         drawingModes: ['polygon', 'polyline'],
    //     },
    //     polygonOptions: {
    //         strokeColor: '#00FF00',
    //         strokeOpacity: 0.8,
    //         strokeWeight: 2,
    //         fillColor: '#00FF00',
    //         fillOpacity: 0.35,
    //     },
    //     polylineOptions: {
    //         strokeColor: '#0000FF',
    //         strokeOpacity: 0.8,
    //         strokeWeight: 2,
    //     },
    // });

    // Set the drawing manager on the map
    // drawingManager.setMap(map);

    // // Add an event listener for when an overlay is complete
    // google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
    //     // Get the overlay (polygon or polyline) that was drawn
    //     const overlay = event.overlay;

    //     // Add the overlay to the map
    //     overlay.setMap(map);

    //     // Add the overlay to the global array (if you want to keep track of them)
    //     markers.push(overlay);

    //     // Add an event listener for click on the overlay
    //     google.maps.event.addListener(overlay, 'click', function() {
    //         // Handle the click event for the overlay (e.g., show information)
    //         console.log('Overlay clicked');
    //     });

    //     // Reset the drawing mode to null (disables drawing)
    //     drawingManager.setDrawingMode(null);
    // });

    // listOfFarm.forEach(farm => {
    //     const marker = new google.maps.Marker({
    //         position: { lat: farm.latitude, lng: farm.longitude },
    //         map: map,
    //         title: farm.location_name,
    //         icon: 'path/to/custom-marker.png', // Replace with the path to your custom marker image
    //     });

    // Create an info window for each marker
    // const infoWindowContent = `<div><strong>${farm.location_name}</strong></div>`;
    // const infoWindow = new google.maps.InfoWindow({
    //     content: infoWindowContent,
    // });

    // Add a click event listener to open the info window when the marker is clicked
    //     marker.addListener('click', function() {
    //         infoWindow.open(map, marker);
    //     });

    //     markers.push(marker); // Add the marker to the global array
    // });

    // Use MarkerClusterer to cluster the markers
    const markerCluster = new MarkerClusterer(map, markers, {
        imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m',
    });





    // Set the polygon on the map
    permDistrictPolygon.setMap(map);

    // Get the file input element
    // const fileInput = document.getElementById('fileInput');

    // Listen for changes in the file input
    fileInput.addEventListener('change', handleFileUpload);

    // Function to handle file upload
    function handleFileUpload(event) {
        const fileInput = event.target;
        const selectedFile = fileInput.files[0];

        if (selectedFile) {
            const reader = new FileReader();

            reader.onload = function(event) {
                const fileContent = event.target.result;
                const fileExtension = selectedFile.name.split('.').pop().toLowerCase();

                // Handle different file types (KML, KMZ, GeoJSON)
                if (fileExtension === 'kml') {
                    displayKML(fileContent);
                } else if (fileExtension === 'kmz') {
                    displayKMZ(fileContent);
                } else if (fileExtension === 'geojson') {
                    displayGeoJSON(fileContent);
                } else {
                    alert('Unsupported file format. Please upload a KML, KMZ, or GeoJSON file.');
                }
            };

            reader.readAsText(selectedFile);
        }
    }

    // Function to display KML data on the map
    function displayKML(kmlData) {
        // Parse and display the KML data on the map using Google Maps JavaScript API
        const kmlLayer = new google.maps.KmlLayer({
            url: 'data:text/xml;charset=UTF-8,' + encodeURIComponent(kmlData),
            map: map
        });
    }

    // Function to display KMZ data on the map
    function displayKMZ(kmzData) {
        // Parse and display the KMZ data on the map using Google Maps JavaScript API
        const kmzLayer = new google.maps.KmlLayer({
            url: 'data:application/vnd.google-earth.kmz+xml;charset=UTF-8,' + encodeURIComponent(kmzData),
            map: map
        });
    }

    // Function to display GeoJSON data on the map
    function displayGeoJSON(geojsonData) {
        // Parse and display the GeoJSON data on the map using Google Maps JavaScript API
        const geojsonLayer = new google.maps.Data();
        geojsonLayer.addGeoJson(JSON.parse(geojsonData));
        geojsonLayer.setMap(map);
    }
    // Create the map instance
    map = new google.maps.Map(document.getElementById('map'), mapOptions);

    // Initialize the drawing manager
    drawingManager = new google.maps.drawing.DrawingManager({
        drawingMode: null,
        drawingControl: true,
        drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_LEFT,
            drawingModes: ['polygon', 'polyline'],
        },
        polygonOptions: {
            strokeColor: '#00FF00',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#00FF00',
            fillOpacity: 0.35,
        },
        polylineOptions: {
            strokeColor: '#0000FF',
            strokeOpacity: 0.8,
            strokeWeight: 2,
        },
    });

    // Set the drawing manager on the map
    drawingManager.setMap(map);

    // Add an event listener for when an overlay is complete
    google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
        // Get the overlay (polygon or polyline) that was drawn
        const overlay = event.overlay;

        // Add the overlay to the map
        overlay.setMap(map);

        // Add the overlay to the global array (if you want to keep track of them)
        markers.push(overlay);

        // Add an event listener for click on the overlay
        google.maps.event.addListener(overlay, 'click', function() {
            // Handle the click event for the overlay (e.g., show information)
            console.log('Overlay clicked');
        });

        // Reset the drawing mode to null (disables drawing)
        drawingManager.setDrawingMode(null);
    });

}