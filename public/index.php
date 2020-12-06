<!doctype html>
<html lang="es">
    <head>
        <title>Gluten Free Store</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    </head>
    <style>
        .fruit {
            background-color: orange;
        }
        .par {
            background-color: #f2f2f2;
        }
        .impar{
            background-color: #ffffff;
        }
    </style>
    <body class="w-100">
        <div id="app">
            <header>
                <nav class="navbar navbar-dark bg-primary">
                    <span class="navbar-brand mb-0 h1">Gluten Free Store</span>
                </nav>
            </header>
            <div class="container-sm pl-md-5 pr-md-5 mb-5">
                <!-- request start-->
                <section class="mt-5">
                    
                    <span class="input-group-btn">
                        <button type="button" onclick="displayFoods()" class="btn btn-primary btn-block text-uppercase">Foods </button>
                    </span>
                    
                </section>
                <!-- request end-->
                
                <!-- response start-->
                <section class="mt-5" id="response">
                    
                </section>
                <!-- response end -->
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
        <script>
            async function displayFoods() 
            {
                let foods = await getFoods();

                let table = `<table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Title</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Rating</th>
                                        </tr>
                                    </thead>
                                    <tbody id="foods">
                                        
                                    </tbody>
                                </table>`;

                $('#response').html(table);

                for (let index = 0; index < foods.length; index++) {
                    let food = foods[index];
                    let classRowColor = '#ffffff';

                    if (food.type == 'fruit') {
                        classRowColor = 'fruit';
                    }else if ((index % 2) == 0) {
                        classRowColor = 'par';
                    }

                    let row = `
                        <tr class="${classRowColor}">
                            <td>${food.title}</td>
                            <td>${food.type}</td>
                            <td>${food.price}</td>
                            <td>${food.rating}</td>
                        </tr>
                    `;
                    $(row).hide().appendTo('#foods').fadeIn();
                }
            }

            async function getFoods() 
            {
                let foods = await fetch('https://api.mocki.io/v1/0a9cd191');
                foods = await foods.json();
                foods = foods.data;
                foods = foods.filter((item,index) => {
                    let notRepeat = foods.map(elemento => { 
                                            return elemento.title; 
                                        }).indexOf(item.title) == index;
                        if (notRepeat && (item.type != 'bakery')) {
                            return true;
                        }

                        return false;
                    });
                
                return foods;
            }
        </script>
    </body>
</html>
