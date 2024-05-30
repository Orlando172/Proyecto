// scripts.js
document.addEventListener("DOMContentLoaded", () => {
    const addButton = document.getElementById('add-button');
    const deleteButton = document.getElementById('delete-button');
    const updateButton = document.getElementById('update-button');
    const orderForm = document.getElementById('order-form');
    const ordersList = document.getElementById('orders');
    
    let selectedOrder = null;

    addButton.addEventListener('click', () => {
        const orderData = new FormData(orderForm);
        const orderItem = document.createElement('li');
        orderItem.innerText = `Mesa: ${orderData.get('mesa')}, Producto: ${orderData.get('producto')}, Cantidad: ${orderData.get('cantidad')}, Precio: ${orderData.get('precio')}`;
        orderItem.addEventListener('click', () => {
            if (selectedOrder) {
                selectedOrder.classList.remove('selected');
            }
            selectedOrder = orderItem;
            orderItem.classList.add('selected');
        });
        ordersList.appendChild(orderItem);
        orderForm.reset();
    });

    deleteButton.addEventListener('click', () => {
        if (selectedOrder) {
            ordersList.removeChild(selectedOrder);
            selectedOrder = null;
        }
    });

    updateButton.addEventListener('click', () => {
        if (selectedOrder) {
            const orderData = new FormData(orderForm);
            selectedOrder.innerText = `Mesa: ${orderData.get('mesa')}, Producto: ${orderData.get('producto')}, Cantidad: ${orderData.get('cantidad')}, Precio: ${orderData.get('precio')}`;
            selectedOrder.classList.remove('selected');
            selectedOrder = null;
            orderForm.reset();
        }
    });
});

window.onload = function() {
    // Realizar la solicitud AJAX para obtener los productos
    fetch('obtenerProductos.php')
      .then(response => response.json())
      .then(data => {
        const productoSelect = document.getElementById('producto');
  
        // Agregar cada producto como una opción en el select
        data.forEach(producto => {
          const option = document.createElement('option');
          option.value = producto.ID_P;
          option.text = producto.nombre_P;
          productoSelect.add(option);
        });
      })
      .catch(error => console.error('Error:', error));
  };
