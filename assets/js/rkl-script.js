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
          document.dispatchEvent(new CustomEvent('rkl:lead-success', { detail: { form: form } }));
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

/* ============================================================================
   Service-page additions (same bundle — no new file)
   • Urgent-symptom notice toggle on the cataract form
   • GA4/GTM dataLayer events: cta_click, lead_form_start, lead_form_submit,
     report_upload, doctor_profile_click, scroll_depth
   ============================================================================ */
(function () {
  'use strict';

  function rklTrack(eventName, params) {
    window.dataLayer = window.dataLayer || [];
    var payload = params || {};
    payload.event = eventName;
    window.dataLayer.push(payload);
  }

  function rklPageService(el) {
    var scoped = el && el.closest ? el.closest('[data-page-service]') : null;
    if (scoped) { return scoped.getAttribute('data-page-service'); }
    var landing = document.querySelector('[data-page-service]');
    return landing ? landing.getAttribute('data-page-service') : 'general';
  }

  /* ---------------- Urgent notice toggle (cataract form) ---------------- */
  document.querySelectorAll('form.rkl-form').forEach(function (form) {
    var concern = form.querySelector('select[name="rk_concern"]');
    var notice = form.querySelector('.rkl-urgent-notice');
    if (concern && notice) {
      concern.addEventListener('change', function () {
        notice.hidden = (concern.value !== 'urgent_symptoms');
      });
    }
  });

  /* ---------------- CTA + doctor card clicks ---------------- */
  document.addEventListener('click', function (event) {
    if (!event.target.closest) { return; }
    var cta = event.target.closest('[data-rkl-cta]');
    if (cta) {
      rklTrack('cta_click', {
        page_service: rklPageService(cta),
        cta_type: cta.getAttribute('data-cta-type') || 'unknown',
        page_path: window.location.pathname
      });
    }
    var doctor = event.target.closest('[data-rkl-doctor]');
    if (doctor) {
      rklTrack('doctor_profile_click', {
        doctor_name: doctor.getAttribute('data-doctor-name') || '',
        page_service: rklPageService(doctor)
      });
    }
  });

  /* ---------------- Form start (once per form) ---------------- */
  document.querySelectorAll('form.rkl-form').forEach(function (form) {
    var started = false;
    form.addEventListener('focusin', function () {
      if (started) { return; }
      started = true;
      var wrap = form.closest('.rkl-form-wrap');
      rklTrack('lead_form_start', {
        page_service: wrap ? (wrap.getAttribute('data-service') || 'general') : 'general',
        page_path: window.location.pathname
      });
    });
  });

  /* ---------------- Form submit success (dispatched by main handler) ---- */
  document.addEventListener('rkl:lead-success', function (event) {
    var form = event.detail && event.detail.form ? event.detail.form : null;
    if (!form) { return; }
    var wrap = form.closest('.rkl-form-wrap');
    var service = wrap ? (wrap.getAttribute('data-service') || 'general') : 'general';
    var params = { page_service: service, page_path: window.location.pathname };
    var concern = form.querySelector('select[name="rk_concern"]');
    if (concern && concern.value) { params.concern = concern.value; }
    var city = form.querySelector('input[name="rk_city"]');
    if (city && city.value) { params.city = city.value; }
    rklTrack('lead_form_submit', params);
    var fileInput = form.querySelector('input[type="file"]');
    if (fileInput && fileInput.files && fileInput.files.length > 0) {
      rklTrack('report_upload', { page_service: service, report_type: 'medical_report' });
    }
  });

  /* ---------------- Scroll depth 50% / 90% (service pages only) --------- */
  var landing = document.querySelector('[data-page-service]');
  if (landing) {
    var serviceName = landing.getAttribute('data-page-service');
    var marks = { 50: false, 90: false };
    var ticking = false;
    function checkDepth() {
      ticking = false;
      var max = document.documentElement.scrollHeight - window.innerHeight;
      if (max <= 0) { return; }
      var pct = Math.round((window.scrollY / max) * 100);
      [50, 90].forEach(function (m) {
        if (!marks[m] && pct >= m) {
          marks[m] = true;
          rklTrack('scroll_depth', { page_service: serviceName, percent: m, page_path: window.location.pathname });
        }
      });
    }
    window.addEventListener('scroll', function () {
      if (!ticking) {
        ticking = true;
        if (window.requestAnimationFrame) { window.requestAnimationFrame(checkDepth); }
        else { checkDepth(); }
      }
    }, { passive: true });
  }
})();
