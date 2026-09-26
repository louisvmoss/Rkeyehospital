================================================================
 RK EYE LANDING TEMPLATES — WORDPRESS INSTALL GUIDE (ASAN TAREEKA)
================================================================
YE PLUGIN KYA KARTA HAI:
  • "LASIK Surgery in Indore" aur "Retinal Detachment Treatment in Indore"
    dono pages ka POORA design + content deta hai
    (site ke real colors mein —
    navy header band, red CTA buttons, sky-blue accents, light-blue
    section backgrounds)
  • Page site ke NORMAL theme header/footer ke saath render hota hai
    (top bar, nav, logo, Second Opinion button — sab as-is rehta hai)
  • Dono pages ke liye ek reusable consultation LEAD FORM built-in hai
    (naam, phone, email, service interest, message)
  • LEADS -> CUSTOM POST TYPE (CPT) mein save hoti hain
    Admin > RK Forms > RK Leads
  • FORM ki NOTIFICATION EMAIL admin se change karo — koi code edit
    nahi chahiye

STEP 1: PLUGIN UPLOAD KARO
  1. WordPress Admin mein login karo
  2. Plugins > Add New Plugin
  3. Upar "Upload Plugin" button par click karo
  4. "Choose File" -> ye ZIP file select karo: rk-eye-lasik-landing.zip
  5. "Install Now" -> "Activate Plugin"

STEP 2: PAGE BANAO
  1. Pages > Add New
  2. Title likho (jaise: LASIK Surgery in Indore)
  3. Right side "Page Attributes" > "Template" dropdown mein select karo:
     RK Eye LASIK Landing, RK Eye Retinal Detachment Guide
     ya RK Eye Cataract Surgery Guide
  4. "Publish"
  5. Page kholo aur check karo — theme ka header/footer waise hi
     rahega, beech mein selected content + form dikhega

RETINAL DETACHMENT PAGE:
  • Suggested title: Retinal Detachment Treatment in Indore
  • Suggested slug: /retinal-detachment-treatment-in-indore/
  • Emergency warning signs, diagnosis, retinal laser, surgery options,
    vitrectomy/gas-bubble safety, recovery guide aur visible FAQs included.
  • Retina page ka form automatically retina-specific options dikhata hai.

CATARACT SURGERY PAGE:
  • Suggested title: Cataract Surgery in Indore
  • Suggested slug: /cataract-surgery-in-indore/
  • Template dropdown me select karo: "RK Eye Cataract Surgery Guide"
  • Symptoms, IOL options (monofocal/toric/multifocal-EDOF cards),
    evaluation, surgery, recovery, doctor team, related services,
    visible FAQs + final CTA band included.
  • Cataract page ka form alag fields dikhata hai: patient name, mobile,
    age, city, main concern, which eye + optional report upload
    (PDF/JPG/PNG, max 5 MB). Report lead ke sath Media Library me
    attachment ki tarah save hoti hai.
  • "Urgent symptom" select karne par form me urgent-care notice dikhta hai.

IMAGES CHANGE KARNA (PAGE EDIT SCREEN):
  Kisi bhi Page ko Edit karo > neeche "RK Landing Page Images" box me
  us page ki images Media Library se set karo:
    - Cataract: hero + lens illustration + evaluation image
    - LASIK: hero + introduction image
    - Retina: hero + condition + diagnosis + recovery images
  Koi field khaali chhodo to global default ya template ki built-in
  image use hoti rahegi.
  Global defaults: WordPress Admin > RK Forms > Landing Images

LEADS KAHAN DEKHEIN?
  WordPress Admin > RK Forms   (left sidebar)
    -> Form ka naam, notification email, shortcode — sab ek jagah
    -> Kisi form ko Edit karo -> "Leads From This Form" box mein
       us form ki recent leads dikhengi

  WordPress Admin > RK Leads   (left sidebar)
    -> Saari leads ek sath (Name, Phone, Email, Procedure, Form, Date)
    -> Upar "Export CSV" link se saari leads CSV mein download karo

NOTIFICATION EMAIL BADALNA HO TO:
  Admin > RK Forms > us form ko "Edit" karo > "Notification Email"
  field mein naya email daalo > "Update" karo. Koi code edit nahi.

REUSABLE FORM SHORTCODE:
  Kisi bhi page par ye shortcode paste karo, wahi form aa jayega:
      [rkl_form]
      [rkl_form id="12"]        (specific form ID se)
  Har form ki apni leads + apni notification email hoti hai.

EMAIL NAHI AAYA? (IMPORTANT)
  WordPress ka default mail (wp_mail) kai baar spam mein chala jaata
  hai ya host block kar deta hai. RECOMMENDED:
    - "WP Mail SMTP" plugin install karo (free)
    - Usme Gmail/Google Workspace ya koi SMTP service connect karo
    - Test mail bhejo
  LEADS DB/CPT MEIN HAMESHA SAVE HOTI HAIN — email fail ho tab bhi.

DESIGN / COLORS / IMAGES BADALNA HO TO:
  - Colors: assets/css/rkl-style.css ke shuru mein (.rkl-landing block)
    CSS variables hain — --rk-navy, --rk-red, --rk-blue waghera.
    Yahan value badlo, poore page ka color update ho jayega.
  - Content/text: templates/template-rkl-lasik.php ya
    templates/template-rkl-retina.php file mein seedha text edit kar sakte ho.
  - Hero/section photos: template file mein <img src="..."> tags
    hain — apni WordPress Media Library ki image URL yahan paste karo.
  - Performance: sab templates ke liye sirf ek shared CSS aur ek shared JS
    file load hoti hai. External Google Fonts/Font Awesome load nahi hote.

SEO:
  Retina template mein semantic headings, visible FAQ content, canonical URL,
  meta description aur MedicalWebPage/MedicalClinic/Breadcrumb/FAQ schema
  included hai. Yoast SEO ya Rank Math installed ho to meta output un plugins
  ko diya jata hai.

AGAR PAGE TITLE PHIR BHI DIKH RAHA HO:
  Kuch themes alag class use karte hain. Woh class batao (page par
  right-click > Inspect > title element ki class) ya theme ka naam
  batao — rule add kar denge.

AGAR PROBLEM AAYE:
  - Template dropdown nahi dikh raha? -> Editor ke 3-dot menu >
    Preferences > Panels > "Page Attributes" ON karo
  - Purana design dikh raha? -> Settings > Permalinks > "Save Changes"
  - Cache plugin use karte ho? -> cache clear karo

PREVIEW:
  Preview ke liye WordPress mein page bana kar template select karo.
  Template active theme ke header/footer ke saath render hota hai,
  FAQ accordion kaam karta hai, aur form leads save/email karta hai.
================================================================
