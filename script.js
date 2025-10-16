// ====== YOUR CATALOG DATA ======
const PRODUCTS = [
  // Agriculture
  {name:'Mahangu (Pearl Millet)', category:'Agriculture', price:45, 
   description:'Locally grown staple grain for porridge and traditional breads grown in the Northern region tasty with sour punch  a highly nutritious and drought resistant cereal grain that is a major staple food for over half of namibia population thrives in arid climate .',
   image:'assets/images/mahangu.jpg'},

   {name:'Bokomo Cornflakes 500g', category:'Agriculture', price:70,
   description:'Crispy golden cornflakes – a breakfast favourite enjoyed across Namibia made specialy  from namibia.',
   image:'assets/images/bokomo-cornflakes.jpg'},

  // Jewelry
  {name:'Himba Necklace', category:'Jewelry', price:220,
   description:'Significant Handcrafted beads made from animal bone and leather inspired by Himba tradition of NAMIBIA used to signify social status fertility, age and beauty unique and ornamental item created with natural materials and often colored with traditional otjize paste giving a distinctive hue.',
   image:'assets/images/himba-necklace.jpg'},

  // Crafts
  {name:'Woven Basket (Medium)', category:'Crafts', price:180,
   description:'Palm/grass basket woven by Kavango artisans In the far north of Namibia, in the Caprivi Strip area of the Okavango Delta, the Kavango and Ovambo people produce these traditional woven baskets. Plant materials are plentiful in this area, which is the largest inland delta on earth and a true oasis in the Kalihari Desert..',
   image:'assets/images/baskets.jpg'},

   {name:'Handcrafted Mat', category:'Crafts', price:250,
   description:'Traditional handwoven mat made from natural reeds, durable and eco-friendly.',
   image:'assets/images/mat.jpg'},

   {name:'Wooden Sculpture', category:'Crafts', price:400,
   description:'Hand-carved wooden sculpture representing Namibian wildlife and culture From welded sculptures to bold fashion, handcrafted masks to unique pottery, meet the artists behind Morris Baba Arts, Ethnic Africa, Out of Katutura, Mewiliko, and Pan and discover truly local treasures..',
   image:'assets/images/sculpture.jpg'},

   // Skincare
  {name:'Facial mask ', category:'Skincare', price:120,
   description:'Natural facial balm made with marula oil and omarula extracts smooth, hydrating and gentle on skinNamibian skincare brand Wellem Cosmetics, founded by Wellem Kapenda in 2021, has introduced a new product: the MAITA Hydrating Face Sheet Mask..',
   image:'assets/images/facial-balm.jpg'},

  // Fashion
  {name:'Leather Shoulder Bag', category:'Fashion', price:780,
   description:'Locally produced leather bag with an adjustable strap and minimalist style KOVA.',
   image:'assets/images/leather-bag.jpg'},

  // Meat & Snacks
  {name:'Beef Biltong 200g', category:'Meat & Snacks', price:80,
   description:'Air-dried beef biltong packed with flavour is not unique but it is one of many traditional dishes across the world based on curing and dehydrating meat (or other proteins) in order to preserve and add flavour to them. The practice is very old as humans have likely been curing meat ever since they discovered the magic of salt..',
   image:'assets/images/biltong.jpg'},
];

// ====== PAGE ELEMENTS ======
const grid  = document.getElementById('grid');
const q     = document.getElementById('q');
const cat   = document.getElementById('cat');
const sort  = document.getElementById('sort');

let products = [];
let shown = [];

async function loadProducts(){
  try {
    const res = await fetch('api/products.php');
    const data = await res.json();
    products = data.products || [];
    shown = products.slice();
    render();
  } catch (e) {
    grid.innerHTML = '<p style="color:#a00">Could not load products. Start PHP or check api/products.php.</p>';
  }
}

function render(){
  const query = (q?.value || '').toLowerCase();
  const category = cat?.value || '';

  shown = products.filter(p=>{
    const t = (p.name + ' ' + p.description).toLowerCase();
    const okText = !query || t.includes(query);
    const okCat  = !category || p.category === category;
    return okText && okCat;
  });

  if (sort?.value === 'name-asc')  shown.sort((a,b)=>a.name.localeCompare(b.name));
  if (sort?.value === 'price-asc') shown.sort((a,b)=>a.price - b.price);
  if (sort?.value === 'price-desc')shown.sort((a,b)=>b.price - a.price);

  grid.innerHTML = shown.map(p => `
    <article class="card">
      <img src="${p.image_url || 'assets/images/placeholder.jpg'}" alt="${p.name}" loading="lazy">
      <div class="p">
        <h3>${p.name}</h3>
        <p>${p.description}</p>
        <div class="meta">
          <span class="badge">${p.category}</span>
          <span class="price">N$ ${Number(p.price).toFixed(2)}</span>
        </div>
      </div>
    </article>
  `).join('');
}

[q,cat,sort].forEach(el => el && el.addEventListener('input', render));
loadProducts();
