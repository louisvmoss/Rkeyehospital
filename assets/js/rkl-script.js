/* ============================================================================
   RK EYE & RETINA CENTER — shared landing page script
   • FAQ accordion
   • Scroll-reveal animation
   • Lead form -> AJAX (admin-ajax.php) -> saved as RK Lead + email notify
   ============================================================================ */
(function () {
  'use strict';
  document.documentElement.classList.add('rkl-js');

  /* ---------------- FAQ Accordion ---------------- */
  document.querySelectorAll('.rkl-faq-question').forEach(function (question) {
    question.addEventListener('click', function () {
      var item = question.parentElement;
       var isDetails = item.tagName.toLowerCase() === 'details';
       var isActive = isDetails ? item.open : item.classList.contains('rkl-active');

      document.querySelectorAll('.rkl-faq-item').forEach(function (faq) {
        faq.classList.remove('rkl-active');
         if (faq.tagName.toLowerCase() === 'details' && faq !== item) {
           faq.open = false;
         }
      });

       if (isDetails) {
         /* Native <details> toggles itself after this click handler. */
       } else if (!isActive) {
        item.classList.add('rkl-active');
      }
    });

     if (question.getAttribute('role') === 'button' || question.tagName.toLowerCase() !== 'summary') {
       question.addEventListener('keydown', function (event) {
         if (event.key === 'Enter' || event.key === ' ') {
           event.preventDefault();
           question.click();
         }
       });
     }
  });

  /* ---------------- Scroll reveal ---------------- */
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('rkl-visible');
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll('.rkl-fade').forEach(function (el) {
      observer.observe(el);
    });
  } else {
    document.querySelectorAll('.rkl-fade').forEach(function (el) {
      el.classList.add('rkl-visible');
    });
  }

  /* ---------------- Lead form submit ---------------- */
  var forms = document.querySelectorAll('form.rkl-form');

  function findModal(form) {
    var wrap = form.closest('.rkl-form-wrap');
    return wrap ? wrap.querySelector('.rkl-modal') : null;
  }

  function handleFormSubmit(event) {
    var form = event.target;
    event.preventDefault();

    if (!form.checkValidity()) {
      form.reportValidity();
      return;
    }

    if (typeof rklAjax === 'undefined') {
      alert('Form handler could not load. Please refresh the page and try again.');
      return;
    }

    var submitBtn = form.querySelector('button[type="submit"]');
    var originalLabel = '';
    if (submitBtn) {
      originalLabel = submitBtn.innerHTML;
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<span>Sending...</span>';
    }

    var fd = new FormData(form);
    fd.append('action', 'rkl_submit_lead');
    fd.append('nonce', rklAjax.nonce);

    fetch(rklAjax.ajax_url, {
      method: 'POST',
      body: fd,
      credentials: 'same-origin'
    })
      .then(function (response) { return response.json(); })
      .then(function (res) {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalLabel;
        }
        if (res && res.success) {
          var modal = findModal(form);
          if (modal) { modal.hidden = false; }
          form.reset();
        } else {
          var msg = (res && res.data && res.data.message) ? res.data.message : 'Something went wrong. Please try again.';
          alert(msg);
        }
      })
      .catch(function () {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalLabel;
        }
        alert('Network error — please check your internet connection and try again.');
      });
  }

  forms.forEach(function (form) {
    form.addEventListener('submit', handleFormSubmit);
  });

  document.querySelectorAll('.rkl-modal').forEach(function (modal) {
    var closeBtn = modal.querySelector('[data-close-modal]');
    if (closeBtn) {
      closeBtn.addEventListener('click', function () { modal.hidden = true; });
    }
    modal.addEventListener('click', function (event) {
      if (event.target === modal) { modal.hidden = true; }
    });
  });

  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
      document.querySelectorAll('.rkl-modal').forEach(function (m) {
        if (!m.hidden) { m.hidden = true; }
      });
    }
  });
})();
