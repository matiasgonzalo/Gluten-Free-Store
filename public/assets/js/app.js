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
    try {
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
    } catch (error) {
        console.error(error);
        return [];
    }
}
