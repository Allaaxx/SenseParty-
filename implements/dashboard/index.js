const sideMenu = document.querySelector('aside');
const menuBtn = document.querySelector('#menu-btn');
const closeBtn = document.querySelector('#close-btn');
const themToggler = document.querySelector('.theme-toggler');


//OPEN BAR
menuBtn.addEventListener('click', () => {
  sideMenu.style.display = 'block';

});

//CLOSER BAR
closeBtn.addEventListener('click', () => {
  sideMenu.style.display = 'none';
});

//CHANGE THEME
themToggler.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme-variables');

    themToggler.querySelector('span:nth-child(1)').classList.toggle('active');
    themToggler.querySelector('span:nth-child(2)').classList.toggle('active');
    });

//fill orders in table

Orders.forEach((order) => {
    const tr = document.createElement('tr');
    const trContent = `
        <td>${order.productName}</td>
        <td>${order.productNumber}</td>
        <td>${order.paymentStatus}</td>
        <td class="${order.shipping === 'Declined' ? 'danger' : order.shipping === 'pending' ? 'warning' : 'primary'}">${order.shipping}</td>
        <td class="primary">Details</td>
    `;
    tr.innerHTML = trContent;
    document.querySelector('table tbody').appendChild(tr);
});
;
    

