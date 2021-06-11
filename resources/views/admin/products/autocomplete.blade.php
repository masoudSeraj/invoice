

<script>
$(document).ready(function(){

    let html;
    let listCount = document.querySelector(".recommended-items ul");
    let itemsList = document.querySelector(".recommended-list")
    let search = document.querySelector(".search");
    let ajaxClickCounter = 1;   //control ajax for sending once when clicks on input and disable multiple ajax calls
    console.log('hello');
    console.log(document.querySelector("meta[name='csrf-token']").getAttribute('content'))
    document.querySelector('body').addEventListener("click", e => {
        // console.time();
        if (e.target.classList.contains("search") && !e.target.value ) {

        // console.log(document.querySelector('recommended-list').children.length)
          $.ajax({
            type: "GET",
            url:'{{url("recommended/lists")}}',
            // dataType: 'json',
            success: (response, status) => {
                console.log(response);
              if ((status = "success")) {
                  let ListContainer = document.createElement("ul");

                  let parentDiv = document
                    .querySelector(".search-container")
                    .insertAdjacentElement(
                      "afterend",
                      document.querySelector(".recommended-list"),
                    );
                  parentDiv.appendChild(ListContainer);
                //   console.log(parentDiv);
                //   result = JSON.parse(response);

                  response.randProducts.forEach(viewed => {
                    let viewedModels = document.createElement("li");

                    // let modelLink = document.createElement('a');
                    viewedModels.setAttribute('data-id', viewed.id);
                    viewedModels.setAttribute('data-price', viewed.price);
                    viewedModels.setAttribute('data-productnumber', e.target.dataset.productnumber);

                    let listContent = document.createTextNode(viewed.name);
                    viewedModels.appendChild(listContent);

                    ListContainer.appendChild(viewedModels);

                  });

                  ListContainer.addEventListener('click', function (event) {
                    let pnum = event.target.dataset.productnumber;
                    let pprice = event.target.dataset.price;
                    // console.log(pprice)
                    if (event.target.tagName == "LI"){
                        // console.log(event.target.textContent);
                        document.querySelector('input[data-productnumber="'+pnum+'"]').value = event.target.textContent;
                        let hiddenInput = document.createElement('input');
                        hiddenInput.setAttribute('type', 'hidden');
                        hiddenInput.setAttribute('name', 'product_id[]');
                        hiddenInput.setAttribute('value', event.target.dataset.id)
                        document.querySelector('input[data-productnumber="'+pnum+'"]').appendChild(hiddenInput);
                        // console.log(document.querySelector('input[data-productnumber="'+pnum+'"]'));
                        // console.log(pnum)
                        // console.log(document.querySelector('#price[data-price="'+pnum+'"]'));
                        document.querySelector('#price[data-price="'+pnum+'"]').value = pprice;
                        // document.querySelector('#price input[data-price="'+pprice+'"]').value = event.target.dataset.price;

                    }
                   })

              }
              ajaxClickCounter = 1;
            },
            error: (jqXHR, textStatus, errorThrown) => {
            console.log(jqXHR, textStatus, errorThrown );
          },

          });

        }


})

})
</script>
