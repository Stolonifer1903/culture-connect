//<!-- declare script constants
        const allProductsButton = document.getElementById('allProducts');
        const allServicesButton = document.getElementById('allServices');
        const closeToMeButton = document.getElementById('closeToMe');
        const furtherAwayButton = document.getElementById('furtherAway');
        const myInterestsButton = document.getElementById('myInterests');
        const myVotedButton = document.getElementById('myVoted');

        console.log ("role:" + role);
        console.log('closeToMeButton:', closeToMeButton);
        console.log('furtherAwayButton:', furtherAwayButton);

    //<!-- set toggle button visibility based on role -->
        function userVisibility(){
            if (role != 1) {
                closeToMeButton.style.display = "none";
                furtherAwayButton.style.display = "none";
                myInterestsButton.style.display = "none";
                myVotedButton.style.display = "none";
                const votes = document.querySelectorAll('[name="votes"]')
                votes.forEach(vote => {
                    vote.style.display = "none";
                });
            }
        }
    
    //<!--get the toggle filter state and call getFilteredOfferings.php -->
        function applyFilters(replace = false) {
            userVisibility(); //refresh what is visible based on user role
            const form = document.getElementById('filters'); //gets the filters form 
            const formData = new FormData(form);            //gets the info from the form
            const params = new URLSearchParams(formData);   //converts the form data to URLSearchParams query string
            
            //if all products or services are selected, change the url to allProducts or allServices
            if (replace) {
                history.replaceState(null, '', 'showOfferings.php?' + params.toString());
            } else {
                history.pushState(null, '', 'showOfferings.php?' + params.toString());
            }

            fetch('include/getFilteredOfferings.php', {     //gets the filtered offerings from the db without reloading the page
                method: 'POST',
                body: formData
            })
            .then(r => r.text())                            //when the query completes, gets the response and converts it to text
            .then(html => {                                 //then inserts the text as html into the grid
                document.getElementById('product-grid').innerHTML = html;       
            });
            
        }
    
    //<!-- toggle show all products / show all services buttons -->
        function toggleAll(name, btn, replace = false) {
        const checkboxes = document.querySelectorAll('input[name="' + name + '[]"]');   //get all the products or services checkboxes
        const allChecked = Array.from(checkboxes).every(cb => cb.checked);              //returns true if all of the boxes are checked
        checkboxes.forEach(cb => cb.checked = !allChecked);                             //checks or unchecks every box depending on allChecked state (does the opposite)
        btn.classList.toggle('active', !allChecked);                                    //toggles the button depending on allChecked state (does the opposite)
        myInterestsButton.classList.toggle('active',false); 
        myVotedButton.classList.toggle('active',false); 
        
        if (allChecked) {
        // checking all - use clean URL
        history.pushState(null, '', 'showOfferings.php?all' + name + '=true');
        }
        applyFilters(replace);                                                                 //fills the grid
        }

    //<!-- toggle close to me button -->
        function toggleCloseToMe(btn) {
        const checkboxes = document.querySelectorAll('input[name="locations[]"]'); //gets all the locations checkboxes
        checkboxes.forEach(cb => cb.checked = false);                               //uncheck all the boxes
        const checkbox = document.querySelector('input[name="locations[]"][value="' + myLocation + '"]');             //finds the checkbox of the location                        
        const isToggled = btn.classList.contains('active');
        if (isToggled) {
            if (checkbox) checkbox.checked = true;
            furtherAwayButton.classList.toggle('active',false);
        }
        applyFilters();
        }

    //<!-- toggle a bit further away button -->
        function toggleABitFurtherAway(btn) {
        const checkboxes = document.querySelectorAll('input[name="locations[]"]'); //gets all the locations checkboxes
        checkboxes.forEach(cb => cb.checked = false);                               //uncheck all the boxes              
        const isToggled = btn.classList.contains('active');
        if (isToggled) {
            myLocations.forEach(location => {
                const checkbox = document.querySelector('input[name="locations[]"][value="' + location + '"]');
                if (checkbox) checkbox.checked = true;   
            })
            closeToMeButton.classList.toggle('active',false); 
        }
        applyFilters();
        }

    //<!-- toggle my interests button -->
        function toggleMyInterests(btn) {
        const checkboxes = document.querySelectorAll('input[name="products[]"], input[name="services[]"]'); //gets all the products and services checkboxes
        checkboxes.forEach(cb => cb.checked = false);                           //uncheck all the boxes            
        const isToggled = btn.classList.contains('active');
        if (isToggled) {
            myInterests.forEach(interest => {
                const productsCheckbox = document.querySelector('input[name="products[]"][value="' + interest + '"]');
                if (productsCheckbox) productsCheckbox.checked = true;   
                const servicesCheckbox = document.querySelector('input[name="services[]"][value="' + interest + '"]');
                if (servicesCheckbox) servicesCheckbox.checked = true; 
            })
            allProducts.classList.toggle('active',false); 
            allServices.classList.toggle('active',false); 
            myVoted.classList.toggle('active',false);
        }
        applyFilters();
        }

    //<!-- toggle my voted items button -->
        function toggleMyVoted(btn) {
        // const checkboxes = document.querySelectorAll('input[name="products[]"], input[name="services[]"]'); //gets all the products and services checkboxes
        // checkboxes.forEach(cb => cb.checked = false);                           //uncheck all the boxes
        // const myVotes = <?php echo json_encode($votes); ?>; //get the user interests from the database                   
        // const isToggled = btn.classList.contains('active');
        // allProducts.classList.toggle('active',false); 
        // allServices.classList.toggle('active',false);
        // myInterests.classList.toggle('active',false);
        // applyFilters();
        }

    //<!-- set the order by input -->
        function setOrderBy(input, btn){
            const popularButton = document.getElementById('popular');
            const azButton = document.getElementById('az');
            const zaButton = document.getElementById('za');
            const prAscButton = document.getElementById('1-9');
            const prDsButton = document.getElementById('9-1');

            //untoggle all buttons
            popularButton.classList.toggle('active',false); 
            azButton.classList.toggle('active',false); 
            zaButton.classList.toggle('active',false); 
            prAscButton.classList.toggle('active',false); 
            prDsButton.classList.toggle('active',false); 

            btn.classList.toggle('active', true)                //toggle the clicked button

            document.getElementById('orderby').value = input;   //set the input value

            applyFilters();                                     //fill the grid
        }

    //<!-- add event listener to handle backwards and forwards browsing -->
        window.addEventListener('popstate', function(){                                     //whenever the user hits the back button
            const params = new URLSearchParams(window.location.search);                     //gets the URL search params from the current page

            document.querySelectorAll('#filters input[type="checkbox"]').forEach(cb=> {     //uncheck every checkbox in the filters form
                cb.checked = false;
            });

            for (const [key, value] of params) {                                            //for each parameter and value in the params string, 
                const checkbox = document.querySelector('input[name="' + key + '"][value="' + value + '"]');             //find a checkbox with the key and value                          
                if (checkbox) checkbox.checked = true;                                      //if there is a matching checkbox, check it
            }

            //get the filtered offerings again from the url
            fetch('include/getFilteredOfferings.php', {     //gets the filtered offerings from the db without reloading the page
                method: 'POST',
                body: params
            })
            .then(r => r.text())                            //when the query completes, gets the response and converts it to text
            .then(html => {                                 //then inserts the text as html into the grid
                document.getElementById('product-grid').innerHTML = html;
            });

        })

    //<-- set input form value to the search bar term
        function doSearch() {
            document.getElementById('search_term').value = document.getElementById('search_input').value;
            applyFilters();
        }

    //<-- add event listener to check if products link has been selected from the homepage
        document.addEventListener('DOMContentLoaded', () => {
            const params = new URLSearchParams(window.location.search);
            if (params.get('allProducts') === 'true') {
                const btn = document.getElementById('allProducts');
                toggleAll('products', btn, true);
            }
        });

    //<-- add event listener to check if services link has been selected from the homepage
        document.addEventListener('DOMContentLoaded', () => {
            const params = new URLSearchParams(window.location.search);
            if (params.get('allServices') === 'true') {
                const btn = document.getElementById('allServices');
                toggleAll('services', btn, true);
            }
        });