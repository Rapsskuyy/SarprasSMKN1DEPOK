// script.js - interactive behavior for Sarpas UI
document.addEventListener('DOMContentLoaded', function(){
  const borrowBtns = document.querySelectorAll('.btn-borrow');
  const modal = document.getElementById('borrow-modal');
  const modalForm = document.getElementById('borrow-form');
  const toast = document.getElementById('toast');

  function showToast(message, type='info'){
    toast.textContent = message;
    toast.classList.add('show');
    setTimeout(()=>toast.classList.remove('show'), 3500);
  }

  function openModalForCard(card){
    const id = card.getAttribute('data-id');
    const stock = parseInt(card.getAttribute('data-stock') || '0',10);
    document.getElementById('modal-item-id').value = id;
    document.getElementById('peminjam-qty').max = stock;
    modal.setAttribute('aria-hidden','false');
  }

  function closeModal(){
    modal.setAttribute('aria-hidden','true');
    modalForm.reset();
  }

  borrowBtns.forEach(btn=>{
    btn.addEventListener('click', function(e){
      const card = e.target.closest('.item-card');
      if(!card) return;
      openModalForCard(card);
    })
  })

  document.querySelectorAll('.modal-close').forEach(btn=>btn.addEventListener('click', closeModal));

  modalForm.addEventListener('submit', function(e){
    e.preventDefault();
    const id = document.getElementById('modal-item-id').value;
    const name = document.getElementById('peminjam-name').value.trim();
    const qty = parseInt(document.getElementById('peminjam-qty').value || '1',10);

    if(!name){ showToast('Masukkan nama peminjam'); return }
    // Simulate success: decrement stock on page
    const card = document.querySelector('.item-card[data-id="'+id+'"]');
    if(card){
      const stockEl = card.querySelector('.stock-value');
      let stock = parseInt(stockEl.textContent || '0',10);
      if(qty > stock){ showToast('Jumlah melebihi stok tersedia', 'danger'); return }
      stock -= qty;
      stockEl.textContent = stock;
      card.setAttribute('data-stock', stock);
      if(stock <= 0){
        const btn = card.querySelector('.btn-borrow');
        if(btn){btn.disabled=true;btn.classList.add('btn-disabled')}
      }
    }

    closeModal();
    showToast('Permintaan peminjaman terkirim — tunggu konfirmasi admin');
  })

  // Close modal by clicking backdrop
  modal.addEventListener('click', function(e){ if(e.target === modal) closeModal(); });

  // Small enhancement: keyboard escape
  document.addEventListener('keyup', function(e){ if(e.key === 'Escape') closeModal(); });
});
