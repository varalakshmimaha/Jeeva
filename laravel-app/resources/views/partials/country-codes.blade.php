@php
  $ccUid     = 'cc_' . substr(md5(uniqid()), 0, 8);
  $defCode   = $default ?? '+91';
  $inputName = $inputName ?? 'country_code';

  $countries = [
    ['code'=>'+93',  'iso'=>'AF','name'=>'Afghanistan'],
    ['code'=>'+355', 'iso'=>'AL','name'=>'Albania'],
    ['code'=>'+213', 'iso'=>'DZ','name'=>'Algeria'],
    ['code'=>'+376', 'iso'=>'AD','name'=>'Andorra'],
    ['code'=>'+244', 'iso'=>'AO','name'=>'Angola'],
    ['code'=>'+54',  'iso'=>'AR','name'=>'Argentina'],
    ['code'=>'+374', 'iso'=>'AM','name'=>'Armenia'],
    ['code'=>'+61',  'iso'=>'AU','name'=>'Australia'],
    ['code'=>'+43',  'iso'=>'AT','name'=>'Austria'],
    ['code'=>'+994', 'iso'=>'AZ','name'=>'Azerbaijan'],
    ['code'=>'+973', 'iso'=>'BH','name'=>'Bahrain'],
    ['code'=>'+880', 'iso'=>'BD','name'=>'Bangladesh'],
    ['code'=>'+375', 'iso'=>'BY','name'=>'Belarus'],
    ['code'=>'+32',  'iso'=>'BE','name'=>'Belgium'],
    ['code'=>'+501', 'iso'=>'BZ','name'=>'Belize'],
    ['code'=>'+229', 'iso'=>'BJ','name'=>'Benin'],
    ['code'=>'+975', 'iso'=>'BT','name'=>'Bhutan'],
    ['code'=>'+591', 'iso'=>'BO','name'=>'Bolivia'],
    ['code'=>'+387', 'iso'=>'BA','name'=>'Bosnia & Herzegovina'],
    ['code'=>'+267', 'iso'=>'BW','name'=>'Botswana'],
    ['code'=>'+55',  'iso'=>'BR','name'=>'Brazil'],
    ['code'=>'+673', 'iso'=>'BN','name'=>'Brunei'],
    ['code'=>'+359', 'iso'=>'BG','name'=>'Bulgaria'],
    ['code'=>'+226', 'iso'=>'BF','name'=>'Burkina Faso'],
    ['code'=>'+257', 'iso'=>'BI','name'=>'Burundi'],
    ['code'=>'+855', 'iso'=>'KH','name'=>'Cambodia'],
    ['code'=>'+237', 'iso'=>'CM','name'=>'Cameroon'],
    ['code'=>'+1',   'iso'=>'CA','name'=>'Canada'],
    ['code'=>'+238', 'iso'=>'CV','name'=>'Cape Verde'],
    ['code'=>'+236', 'iso'=>'CF','name'=>'Central African Rep.'],
    ['code'=>'+235', 'iso'=>'TD','name'=>'Chad'],
    ['code'=>'+56',  'iso'=>'CL','name'=>'Chile'],
    ['code'=>'+86',  'iso'=>'CN','name'=>'China'],
    ['code'=>'+57',  'iso'=>'CO','name'=>'Colombia'],
    ['code'=>'+269', 'iso'=>'KM','name'=>'Comoros'],
    ['code'=>'+506', 'iso'=>'CR','name'=>'Costa Rica'],
    ['code'=>'+385', 'iso'=>'HR','name'=>'Croatia'],
    ['code'=>'+53',  'iso'=>'CU','name'=>'Cuba'],
    ['code'=>'+357', 'iso'=>'CY','name'=>'Cyprus'],
    ['code'=>'+420', 'iso'=>'CZ','name'=>'Czechia'],
    ['code'=>'+45',  'iso'=>'DK','name'=>'Denmark'],
    ['code'=>'+253', 'iso'=>'DJ','name'=>'Djibouti'],
    ['code'=>'+593', 'iso'=>'EC','name'=>'Ecuador'],
    ['code'=>'+20',  'iso'=>'EG','name'=>'Egypt'],
    ['code'=>'+503', 'iso'=>'SV','name'=>'El Salvador'],
    ['code'=>'+372', 'iso'=>'EE','name'=>'Estonia'],
    ['code'=>'+251', 'iso'=>'ET','name'=>'Ethiopia'],
    ['code'=>'+679', 'iso'=>'FJ','name'=>'Fiji'],
    ['code'=>'+358', 'iso'=>'FI','name'=>'Finland'],
    ['code'=>'+33',  'iso'=>'FR','name'=>'France'],
    ['code'=>'+995', 'iso'=>'GE','name'=>'Georgia'],
    ['code'=>'+49',  'iso'=>'DE','name'=>'Germany'],
    ['code'=>'+233', 'iso'=>'GH','name'=>'Ghana'],
    ['code'=>'+30',  'iso'=>'GR','name'=>'Greece'],
    ['code'=>'+502', 'iso'=>'GT','name'=>'Guatemala'],
    ['code'=>'+509', 'iso'=>'HT','name'=>'Haiti'],
    ['code'=>'+504', 'iso'=>'HN','name'=>'Honduras'],
    ['code'=>'+852', 'iso'=>'HK','name'=>'Hong Kong'],
    ['code'=>'+36',  'iso'=>'HU','name'=>'Hungary'],
    ['code'=>'+354', 'iso'=>'IS','name'=>'Iceland'],
    ['code'=>'+91',  'iso'=>'IN','name'=>'India'],
    ['code'=>'+62',  'iso'=>'ID','name'=>'Indonesia'],
    ['code'=>'+98',  'iso'=>'IR','name'=>'Iran'],
    ['code'=>'+964', 'iso'=>'IQ','name'=>'Iraq'],
    ['code'=>'+353', 'iso'=>'IE','name'=>'Ireland'],
    ['code'=>'+972', 'iso'=>'IL','name'=>'Israel'],
    ['code'=>'+39',  'iso'=>'IT','name'=>'Italy'],
    ['code'=>'+81',  'iso'=>'JP','name'=>'Japan'],
    ['code'=>'+962', 'iso'=>'JO','name'=>'Jordan'],
    ['code'=>'+7',   'iso'=>'KZ','name'=>'Kazakhstan'],
    ['code'=>'+254', 'iso'=>'KE','name'=>'Kenya'],
    ['code'=>'+965', 'iso'=>'KW','name'=>'Kuwait'],
    ['code'=>'+996', 'iso'=>'KG','name'=>'Kyrgyzstan'],
    ['code'=>'+856', 'iso'=>'LA','name'=>'Laos'],
    ['code'=>'+371', 'iso'=>'LV','name'=>'Latvia'],
    ['code'=>'+961', 'iso'=>'LB','name'=>'Lebanon'],
    ['code'=>'+218', 'iso'=>'LY','name'=>'Libya'],
    ['code'=>'+370', 'iso'=>'LT','name'=>'Lithuania'],
    ['code'=>'+352', 'iso'=>'LU','name'=>'Luxembourg'],
    ['code'=>'+853', 'iso'=>'MO','name'=>'Macau'],
    ['code'=>'+60',  'iso'=>'MY','name'=>'Malaysia'],
    ['code'=>'+960', 'iso'=>'MV','name'=>'Maldives'],
    ['code'=>'+356', 'iso'=>'MT','name'=>'Malta'],
    ['code'=>'+222', 'iso'=>'MR','name'=>'Mauritania'],
    ['code'=>'+230', 'iso'=>'MU','name'=>'Mauritius'],
    ['code'=>'+52',  'iso'=>'MX','name'=>'Mexico'],
    ['code'=>'+373', 'iso'=>'MD','name'=>'Moldova'],
    ['code'=>'+377', 'iso'=>'MC','name'=>'Monaco'],
    ['code'=>'+976', 'iso'=>'MN','name'=>'Mongolia'],
    ['code'=>'+382', 'iso'=>'ME','name'=>'Montenegro'],
    ['code'=>'+212', 'iso'=>'MA','name'=>'Morocco'],
    ['code'=>'+258', 'iso'=>'MZ','name'=>'Mozambique'],
    ['code'=>'+95',  'iso'=>'MM','name'=>'Myanmar'],
    ['code'=>'+264', 'iso'=>'NA','name'=>'Namibia'],
    ['code'=>'+977', 'iso'=>'NP','name'=>'Nepal'],
    ['code'=>'+31',  'iso'=>'NL','name'=>'Netherlands'],
    ['code'=>'+64',  'iso'=>'NZ','name'=>'New Zealand'],
    ['code'=>'+505', 'iso'=>'NI','name'=>'Nicaragua'],
    ['code'=>'+227', 'iso'=>'NE','name'=>'Niger'],
    ['code'=>'+234', 'iso'=>'NG','name'=>'Nigeria'],
    ['code'=>'+47',  'iso'=>'NO','name'=>'Norway'],
    ['code'=>'+968', 'iso'=>'OM','name'=>'Oman'],
    ['code'=>'+92',  'iso'=>'PK','name'=>'Pakistan'],
    ['code'=>'+970', 'iso'=>'PS','name'=>'Palestine'],
    ['code'=>'+507', 'iso'=>'PA','name'=>'Panama'],
    ['code'=>'+675', 'iso'=>'PG','name'=>'Papua New Guinea'],
    ['code'=>'+595', 'iso'=>'PY','name'=>'Paraguay'],
    ['code'=>'+51',  'iso'=>'PE','name'=>'Peru'],
    ['code'=>'+63',  'iso'=>'PH','name'=>'Philippines'],
    ['code'=>'+48',  'iso'=>'PL','name'=>'Poland'],
    ['code'=>'+351', 'iso'=>'PT','name'=>'Portugal'],
    ['code'=>'+974', 'iso'=>'QA','name'=>'Qatar'],
    ['code'=>'+40',  'iso'=>'RO','name'=>'Romania'],
    ['code'=>'+7',   'iso'=>'RU','name'=>'Russia'],
    ['code'=>'+250', 'iso'=>'RW','name'=>'Rwanda'],
    ['code'=>'+966', 'iso'=>'SA','name'=>'Saudi Arabia'],
    ['code'=>'+221', 'iso'=>'SN','name'=>'Senegal'],
    ['code'=>'+381', 'iso'=>'RS','name'=>'Serbia'],
    ['code'=>'+248', 'iso'=>'SC','name'=>'Seychelles'],
    ['code'=>'+65',  'iso'=>'SG','name'=>'Singapore'],
    ['code'=>'+421', 'iso'=>'SK','name'=>'Slovakia'],
    ['code'=>'+386', 'iso'=>'SI','name'=>'Slovenia'],
    ['code'=>'+27',  'iso'=>'ZA','name'=>'South Africa'],
    ['code'=>'+82',  'iso'=>'KR','name'=>'South Korea'],
    ['code'=>'+34',  'iso'=>'ES','name'=>'Spain'],
    ['code'=>'+94',  'iso'=>'LK','name'=>'Sri Lanka'],
    ['code'=>'+249', 'iso'=>'SD','name'=>'Sudan'],
    ['code'=>'+46',  'iso'=>'SE','name'=>'Sweden'],
    ['code'=>'+41',  'iso'=>'CH','name'=>'Switzerland'],
    ['code'=>'+963', 'iso'=>'SY','name'=>'Syria'],
    ['code'=>'+886', 'iso'=>'TW','name'=>'Taiwan'],
    ['code'=>'+992', 'iso'=>'TJ','name'=>'Tajikistan'],
    ['code'=>'+255', 'iso'=>'TZ','name'=>'Tanzania'],
    ['code'=>'+66',  'iso'=>'TH','name'=>'Thailand'],
    ['code'=>'+216', 'iso'=>'TN','name'=>'Tunisia'],
    ['code'=>'+90',  'iso'=>'TR','name'=>'Türkiye'],
    ['code'=>'+993', 'iso'=>'TM','name'=>'Turkmenistan'],
    ['code'=>'+256', 'iso'=>'UG','name'=>'Uganda'],
    ['code'=>'+380', 'iso'=>'UA','name'=>'Ukraine'],
    ['code'=>'+971', 'iso'=>'AE','name'=>'UAE'],
    ['code'=>'+44',  'iso'=>'GB','name'=>'United Kingdom'],
    ['code'=>'+1',   'iso'=>'US','name'=>'United States'],
    ['code'=>'+598', 'iso'=>'UY','name'=>'Uruguay'],
    ['code'=>'+998', 'iso'=>'UZ','name'=>'Uzbekistan'],
    ['code'=>'+58',  'iso'=>'VE','name'=>'Venezuela'],
    ['code'=>'+84',  'iso'=>'VN','name'=>'Vietnam'],
    ['code'=>'+967', 'iso'=>'YE','name'=>'Yemen'],
    ['code'=>'+260', 'iso'=>'ZM','name'=>'Zambia'],
    ['code'=>'+263', 'iso'=>'ZW','name'=>'Zimbabwe'],
  ];

  $selCode = old($inputName, $defCode);
  $selCountry = collect($countries)->first(fn($c) => $c['code'] === $selCode) ?? collect($countries)->first(fn($c) => $c['code'] === '+91');
@endphp

<div class="cc-wrap" id="{{ $ccUid }}">
  <input type="hidden" name="{{ $inputName }}" id="{{ $ccUid }}_val" value="{{ $selCode }}">
  <button type="button"
          class="cc-trigger"
          id="{{ $ccUid }}_btn"
          aria-haspopup="listbox"
          aria-expanded="false"
          onclick="ccToggle('{{ $ccUid }}')">
    <img src="https://flagcdn.com/20x15/{{ strtolower($selCountry['iso']) }}.png"
         width="20" height="15"
         class="cc-flag"
         id="{{ $ccUid }}_flag"
         alt="{{ $selCountry['name'] }}">
    <span class="cc-code" id="{{ $ccUid }}_code">{{ $selCode }}</span>
    <svg class="cc-chevron" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
  </button>
  <div class="cc-panel" id="{{ $ccUid }}_panel" style="display:none;">
    <div class="cc-search-wrap">
      <svg class="cc-search-ico" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input type="text"
             class="cc-search"
             id="{{ $ccUid }}_search"
             placeholder="Search country..."
             autocomplete="off"
             oninput="ccSearch('{{ $ccUid }}', this.value)">
    </div>
    <div class="cc-list" id="{{ $ccUid }}_list" role="listbox">
      @foreach($countries as $c)
      <div class="cc-opt{{ $c['code']===$selCode && $c['iso']===$selCountry['iso'] ? ' cc-sel' : '' }}"
           data-code="{{ $c['code'] }}"
           data-iso="{{ strtolower($c['iso']) }}"
           data-name="{{ strtolower($c['name']) }}"
           role="option"
           tabindex="-1"
           onclick="ccPick('{{ $ccUid }}',this)">
        <img src="https://flagcdn.com/20x15/{{ strtolower($c['iso']) }}.png" width="20" height="15" loading="lazy" alt="{{ $c['name'] }}">
        <span class="cc-opt-name">{{ $c['name'] }}</span>
        <span class="cc-opt-code">{{ $c['code'] }}</span>
      </div>
      @endforeach
      <div class="cc-no-results" id="{{ $ccUid }}_empty" style="display:none;">No results found</div>
    </div>
  </div>
</div>

@once
<style>
.cc-wrap { position: relative; display: inline-block; }
.cc-trigger {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 0 10px;
  height: 100%;
  min-height: 44px;
  background: transparent;
  border: none;
  cursor: pointer;
  font-family: 'Outfit', sans-serif;
  font-size: 14px;
  font-weight: 600;
  color: #1f3b38;
  white-space: nowrap;
}
.cc-trigger:focus { outline: none; }
.cc-flag { border-radius: 2px; display: block; flex-shrink: 0; box-shadow: 0 0 0 1px rgba(0,0,0,.08); }
.cc-code { font-size: 13px; font-weight: 700; color: #1f3b38; }
.cc-chevron { color: #6b7280; flex-shrink: 0; transition: transform .2s; }
.cc-trigger[aria-expanded="true"] .cc-chevron { transform: rotate(180deg); }

.cc-panel {
  position: absolute;
  top: calc(100% + 4px);
  left: 0;
  z-index: 9999;
  width: 270px;
  background: #fff;
  border: 1px solid #e5e7eb;
  border-radius: 12px;
  box-shadow: 0 8px 32px rgba(0,0,0,0.13);
  overflow: hidden;
}
.cc-search-wrap {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 10px 12px;
  border-bottom: 1px solid #f0f0f0;
  background: #fafafa;
}
.cc-search-ico { flex-shrink: 0; }
.cc-search {
  flex: 1;
  border: none;
  background: transparent;
  outline: none;
  font-family: 'Outfit', sans-serif;
  font-size: 13px;
  color: #1a1a1a;
}
.cc-search::placeholder { color: #b0aaa5; }
.cc-no-results {
  padding: 14px;
  text-align: center;
  font-family: 'Outfit', sans-serif;
  font-size: 13px;
  color: #9ca3af;
}
.cc-list {
  max-height: 210px;
  overflow-y: auto;
  overscroll-behavior: contain;
}
.cc-list::-webkit-scrollbar { width: 4px; }
.cc-list::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 4px; }
.cc-opt {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 9px 14px;
  cursor: pointer;
  transition: background .15s;
}
.cc-opt:hover { background: #f0faf9; }
.cc-opt.cc-sel { background: #e8f5f4; }
.cc-opt img { border-radius: 2px; flex-shrink: 0; box-shadow: 0 0 0 1px rgba(0,0,0,.08); }
.cc-opt-name {
  flex: 1;
  font-family: 'Outfit', sans-serif;
  font-size: 13px;
  color: #1a1a1a;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.cc-opt-code {
  font-family: 'Outfit', sans-serif;
  font-size: 12px;
  color: #6b7280;
  flex-shrink: 0;
}
.cc-opt.cc-sel .cc-opt-name { color: #2FA9A3; font-weight: 600; }
.cc-opt.cc-sel .cc-opt-code { color: #2FA9A3; }

/* Generic: any phone-row wrapper that contains a cc-wrap */
.phone-row .cc-wrap,
.bf-phone-group .cc-wrap,
.bk-cc-wrap {
  flex-shrink: 0;
}
</style>
<script>
(function(){
  function ccToggle(uid) {
    var panel  = document.getElementById(uid + '_panel');
    var btn    = document.getElementById(uid + '_btn');
    var search = document.getElementById(uid + '_search');
    var open   = panel.style.display === 'none' || panel.style.display === '';
    /* close all other panels */
    document.querySelectorAll('.cc-panel').forEach(function(p){ p.style.display='none'; });
    document.querySelectorAll('.cc-trigger').forEach(function(b){ b.setAttribute('aria-expanded','false'); });
    if (open) {
      panel.style.display = 'block';
      btn.setAttribute('aria-expanded','true');
      /* reset search */
      if (search) { search.value = ''; ccSearch(uid, ''); }
      /* focus search box */
      setTimeout(function(){
        if (search) search.focus();
        /* scroll selected item into view */
        var sel = panel.querySelector('.cc-sel');
        if (sel) sel.scrollIntoView({ block: 'nearest' });
      }, 30);
    }
  }
  function ccSearch(uid, q) {
    var list  = document.getElementById(uid + '_list');
    var empty = document.getElementById(uid + '_empty');
    var term  = q.toLowerCase().trim();
    var found = 0;
    list.querySelectorAll('.cc-opt').forEach(function(el) {
      var match = !term
        || el.dataset.name.indexOf(term) !== -1
        || el.dataset.code.indexOf(term) !== -1;
      el.style.display = match ? '' : 'none';
      if (match) found++;
    });
    if (empty) empty.style.display = found === 0 ? '' : 'none';
  }
  function ccPick(uid, el) {
    document.getElementById(uid + '_val').value   = el.dataset.code;
    document.getElementById(uid + '_flag').src    = 'https://flagcdn.com/20x15/' + el.dataset.iso + '.png';
    document.getElementById(uid + '_flag').alt    = el.querySelector('.cc-opt-name').textContent;
    document.getElementById(uid + '_code').textContent = el.dataset.code;
    var list = document.getElementById(uid + '_list');
    list.querySelectorAll('.cc-opt').forEach(function(o){ o.classList.remove('cc-sel'); });
    el.classList.add('cc-sel');
    document.getElementById(uid + '_panel').style.display = 'none';
    document.getElementById(uid + '_btn').setAttribute('aria-expanded','false');
  }
  document.addEventListener('click', function(e){
    if (!e.target.closest('.cc-wrap')) {
      document.querySelectorAll('.cc-panel').forEach(function(p){ p.style.display='none'; });
      document.querySelectorAll('.cc-trigger').forEach(function(b){ b.setAttribute('aria-expanded','false'); });
    }
  });
  window.ccToggle = ccToggle;
  window.ccSearch = ccSearch;
  window.ccPick   = ccPick;
})();
</script>
@endonce
