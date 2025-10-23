const home = document.getElementById('car-catalog');
const lcgc = document.getElementById('lcgc-catalog');
const mpv = document.getElementById('mpv-catalog');
const suv = document.getElementById('suv-catalog');
const pickup = document.getElementById('pickup-catalog');

cars.forEach(c => {
  const el = document.createElement('a');
  el.className = 'car-item';
  el.href = 'kontak.html';
  el.innerHTML = `
    <img src="${c.image}">
    <div class="car-details">
      <h2>${c.name} (${c.year})</h2>
      <p>${c.description}</p>
      <span class="rental-price">Sewa/Hari: ${c.rental_price_day}</span>
      <span class="car-status" style="color:${c.status === 'Tersedia' ? '#28a745' : '#dc3545'}">Status: ${c.status}</span>
    </div>`;
  
  if (home && cars.indexOf(c) < 4) home.appendChild(el);
  if (lcgc && c.category === 'lcgc') lcgc.appendChild(el.cloneNode(true));
  if (mpv && c.category === 'mpv') mpv.appendChild(el.cloneNode(true));
  if (suv && c.category === 'suv') suv.appendChild(el.cloneNode(true));
  if (pickup && c.category === 'pickup') pickup.appendChild(el.cloneNode(true));
});

window.scrollToCategory = id => 
  document.getElementById(id)?.scrollIntoView({ behavior: 'smooth' });


/