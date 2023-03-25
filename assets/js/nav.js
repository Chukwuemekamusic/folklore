let dropdowns = document.querySelectorAll('.dropdown-toggle')
        dropdowns.forEach((dd) => {
            dd.addEventListener('click', function(e) {
                var el = this.nextElementSibling
                el.style.display = el.style.display === 'block' ? 'none' : 'block'
                el.classList.toggle('show');
                el.classList.toggle('open');

                // hide other dropdowns
                
            })
        })
        //  #TODO add REFERENCES https://www.codeply.com/p/rhCuZhEUrk 

        // const dropdowns = document.querySelectorAll('.dropdown-toggle');

        // dropdowns.forEach((dropdown) => {
        //   dropdown.addEventListener('click', function() {
        //     const sibling = this.nextElementSibling;
        //     const isActive = sibling.classList.contains('active');
        
        //     // Hide all dropdowns
        //     dropdowns.forEach((dd) => {
        //       dd.nextElementSibling.classList.remove('active');
        //     });
        
        //     // Show/hide the clicked dropdown
        //     if (!isActive) {
        //       sibling.classList.add('active');
        //     }
        //   });
        // });
        


