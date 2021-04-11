import stripeKeys from "./stripe-keys.js";
import STRIPE_KEYS from "./stripe-keys.js"; // se importan las llaves de stripe

// console.log(STRIPE_KEYS)

const d = document,
    $cursos = d.getElementById("cursos"),
    $template = d.getElementById("curso-template").content,
    $fragment = d.createDocumentFragment(),
    
    // Se define objeto fetchOptions
    fetchOptions = {
        headers: {
            Authorization:`Bearer ${STRIPE_KEYS.secret}`,
        },
    }

    // Variables vacías que se usan posteriormente
    let products,prices; 

    // Formato de moneda para visualización del precio
    const moneyFormat = num => `$${num.slice(0,-2)}`;    // elimina las 2 ultimas posiciones de la cadena

    // Promise.all recibe las peticiones a manera de arreglo
    Promise.all([ 
        fetch("https://api.stripe.com/v1/products",fetchOptions),
        fetch("https://api.stripe.com/v1/prices",fetchOptions)
    ])
    .then(responses => Promise.all(responses.map(res => res.json())))
    .then(json=>{
       // console.log(json);
        products = json[0].data
        prices = json[1].data
        //console.log(products,prices);

        // se compara el product del precio con el id del producto
        prices.forEach((el) => {
            let productData = products.filter(product => product.id === el.product);
            //console.log(productData);

            $template.querySelector(".curso").setAttribute("data-price",el.id);
            $template.querySelector("img").src=productData[0].images[0];
            $template.querySelector("img").alt=productData[0].name;
            $template.querySelector("figcaption").innerHTML = `
                ${moneyFormat(el.unit_amount_decimal)} ${el.currency}
                <br>
            `;
            // se clona el template y se agrega al fragmento
            let $clone = d.importNode($template,true);
            $fragment.appendChild($clone)
        });

        $cursos.appendChild($fragment);
    })
    .catch((err)=>{
        console.log(err);
        let message = err.statusText || "Ocurrio error al conectarse con el API de Stripe"
        $cursos.innerHTML = `<p>Error ${err.status}:${message}</p>`;
    });

    d.addEventListener("click", (e)=> {
        if(e.target.matches(".curso *")){
            let price = e.target.parentElement.getAttribute("data-price");
            //console.log(price)
            Stripe(STRIPE_KEYS.public)
            .redirectToCheckout({
                lineItems:[{price,quantity:1}],
                mode: "subscription",
                successUrl: "http://localhost/Cursos_App/php/stripe-success.php",
                cancelUrl: "http://localhost/Cursos_App/php/stripe-cancel.php",
            })
            .then((res) => {
                console.log(res);
                if(res.error){
                    $cursos.insertAdjacentHTML("afterend", res.error.message);
                }
            })
        }
    });



/*----- Petición para los productos ----- //
fetch("https://api.stripe.com/v1/products", {
    headers: {
        Authorization:`Bearer ${STRIPE_KEYS.secret}`,
    },
}).then((res)=>{
    console.log(res);
    return res.json()
})
.then(json=>{
    console.log(json);
});

//----- Petición para los precios -----//
fetch("https://api.stripe.com/v1/prices", {
    headers: {
        Authorization:`Bearer ${STRIPE_KEYS.secret}`,
    },
}).then((res)=>{
    console.log(res);
    return res.json()
})
.then(json=>{
    console.log(json);
});*/