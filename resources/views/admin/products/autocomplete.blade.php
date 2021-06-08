

<script>

    let html;
    let listCount = document.querySelector(".recommended-items ul");
    let itemsList = document.querySelector(".recommended-list")
    let search = document.querySelector(".search");
    let ajaxClickCounter = 1;   //control ajax for sending once when clicks on input and disable multiple ajax calls
console.log('hello');
   document.querySelector('body').addEventListener("click", e => {
        // console.time();
        if (e.target.classList.contains("search") && search.children.length == 0 && ajaxClickCounter == 1 &&
         itemsList.children.length == 0 && listCount.children.length == 0 && !document.querySelector(".search").value) {
          document.querySelector(".search-overlay").classList.add('is-active');
          // document.querySelector(".recommended-items ul").classList.add('is-active-flex');
          ajaxClickCounter = 0;
          $.ajax({
            type: "GET",
            url: "{{ url('recommended/lists') }}",
            success: (response, status) => {
              if ((status = "success")) {
                if (search.children.length == 0) {
                  let ListContainer = document.createElement("ul");

                  let parentDiv = document
                    .querySelector(".search-container")
                    .insertAdjacentElement(
                      "afterend",
                      document.querySelector(".recommended-list"),
                    );
                  parentDiv.appendChild(ListContainer);
                  result = JSON.parse(response);

                  result.most_viewed.forEach(viewed => {
                    let viewedModels = document.createElement("li");
                    let modelLink = document.createElement('a');
                    let modelDiv = document.createElement('div');
                    viewedModels.appendChild(modelDiv);
                    modelDiv.appendChild(modelLink);
                    modelLink.setAttribute("href", `/productdetails.php?model=${viewed.model}`);
                    modelLink.classList.add("modelHref");

                    ListContainer.appendChild(viewedModels);
                    let listContent = document.createTextNode(viewed.model);
                    modelLink.appendChild(listContent);
                  });
                }

              }
              ajaxClickCounter = 1;
            },
            error: () => {},

          });        }
        else if(search.value && e.target.classList.contains("search") && ajaxClickCounter === 1){ //control click behavior when search box does have some words
          ajaxClickCounter = 0;
          searchText = $("form.ajax-search").serialize();

          $.ajax({
            type: "POST",
            url: "/search.php",
            data: searchText,
            beforeSend: () => { },
            success: (response, status, obj) => {
              if (
                document.querySelector(".recommended-items").children.length === 0
              ) {
              } else {
                document.querySelector(".recommended-items ul").innerHTML = "";
                result = JSON.parse(response);
                let searchValue = document.querySelector(".search").value;


                result.term.forEach((element) => {
                  html =
                    "<li>" +
                    '<a href="/productdetails.php?model=' +
                    element.model +
                    '">' +
                    highlight(element.model.toLowerCase(), searchValue);
                    "</a>" +
                    "</li>";
                  document.querySelector(".recommended-items ul").innerHTML += html;


                  document.querySelector(".search-overlay").classList.add("is-active");   // add search overlay to background
                  document.querySelector(".recommended-items ul").classList.add("is-active-flex");  // display ul
                });

              }

            },
            error: () => {
              console.log("error");
            },
          });

        }
        else if (e.target.classList.contains("is-active")){   //click on overlay
          // console.log(e.target)
          if (document.querySelector('.recommended-list').children.length > 0) {
            document.querySelector('.recommended-list ul').remove();
          }
          else if(document.querySelector(".recommended-items ul").children.length > 0){          //remove recommended items
            liArray = Array.from(document.querySelectorAll(".recommended-items ul li"));
            liArray.forEach(value =>{
              value.remove();
            })
            hideRecommendedItems();
          }
          e.target.classList.remove('is-active');
        }
        // console.timeEnd();
  });


  doSearch = function(e){

    if (e.keyCode != 16 && e.keyCode != 17 && e.keyCode != 18 && search.value.length !=0 && ajaxClickCounter == 1) {// Handle alt, shift and ctrl and also start this section if the search box is not empty

      createCrossbar();

      checkRecommended();

      addOverlay();

      if (document.querySelector(".recommended-list").children.length){ //remove recommended-list on key up

        document.querySelector(".recommended-list ul").remove();

      }


      if(e.target.classList.contains('fa-times')){          // click on x sign when you type a word
        document.querySelector('form.ajax-search').reset();
        removeCrossbar();
        if(document.querySelector(".recommended-items ul").children.length > 0){          //remove recommended items
          liArray = Array.from(document.querySelectorAll(".recommended-items ul li"));
          liArray.forEach(value =>{
            value.remove();
          })
        }
        hideRecommendedItems();
        removeOverlay();
        e.stopPropagation();
      }


       else {
        let searchText = $("form.ajax-search").serialize();
        $.ajax({
          type: "POST",
          url: "/search.php",
          data: searchText,
          beforeSend: () => { },
          success: (response) => {

            if (
              document.querySelector(".recommended-items").children.length === 0
            ) {

            } else {
              document.querySelector(".recommended-items ul").innerHTML = "";
            }

            result = JSON.parse(response);

            let searchValue = document.querySelector(".search").value;

            result.term.forEach((element, index) => {
              // let modelHref = "/productdetails.php?model" + element.model;
              html =
                "<li>" +
                '<a data-index="'+ index +'"' + 'href="/productdetails.php?model=' +
                element.model +
                '">' +
                highlight(element.model.toLowerCase(), searchValue) +
                "</a>" +
                "</li>";
              document.querySelector(".recommended-items ul").innerHTML += html;
            });


          },
          error: () => {
            console.log("error");
          },
        });
      }
    }
    else if (e.keyCode != 16 && e.keyCode != 17 && e.keyCode != 18 && document.querySelector(".search").value.length == "" &&
     e.type != "click"  && ajaxClickCounter == 1) { //remove recommended items when text-input is empty

      let liTags = document.querySelectorAll(".recommended-items ul li");
      liTags.forEach((value) => {
        value.remove();
      })

      document.querySelector(".search-overlay").classList.remove('is-active');
      // document.querySelector(".recommended-items ul").display = "none";
      document.querySelector(".recommended-items ul").classList.remove('is-active-flex');
      removeCrossbar();
    }
    else if (
      document.querySelector(".search").value === "" &&         //control backspace behavior when input is empty
      e.keyCode === 8 //backspace
    ) {

      // document.querySelector(".recommended-items ul").display = "none";
    }
    ajaxClickCounter = 1;
  }

  // add multiple event listeners to same object

  let elementSearch = document.querySelector('.ajax-search');

  ['keyup', 'click'].forEach(element => {
    elementSearch.addEventListener(element, doSearch)
  });

  console.log(ajaxClickCounter);


  highlight = function(element, text) {

      // console.log(element);
      let index = element.indexOf(text)
      if(index >= 0){
        element = element.substring(0,index) + "<span class='highlight'>" + element.substring(index,index+text.length) + "</span>" + element.substring(index + text.length);
        // console.log(element);
        return element;
      }
  }
  createCrossbar = function() {

    let crossbar = document.createElement('div');
    crossbar.classList.add('crossbar-container');
    let faCrossbar = document.createElement("i");
    faCrossbar.classList.add("fa", "fa-times");
    crossbar.appendChild(faCrossbar)
    if(!document.querySelector('.crossbar-container')){
      document.querySelector('.search-container').appendChild(crossbar);
      }

    }


    removeCrossbar = function(){
      if(!document.querySelector('.search').value && document.querySelector('.search-container')){
        document.querySelector('.crossbar-container').remove();
      }
    }

    checkRecommended = function(){
      if(!document.querySelector('.recommended-items ul').classList.contains("is-active-flex")){  // if this class is not there, the ul is display: none
        document.querySelector('.recommended-items ul').classList.add("is-active-flex");
      }
    }

    addOverlay = function(){
      if(!document.querySelector('.search-overlay').classList.contains("is-active")){             // add is-active class for display the overlay
        document.querySelector('.search-overlay').classList.add("is-active");
      }
    }
    removeOverlay = function(){
      if(document.querySelector(".search-overlay").classList.contains("is-active")){
        document.querySelector(".search-overlay").classList.remove('is-active');
      }
    }
    hideRecommendedItems = function(){
      if(document.querySelector(".recommended-items ul").classList.contains("is-active-flex")){
        document.querySelector(".recommended-items ul").classList.remove('is-active-flex');
      }
    }



</script>
