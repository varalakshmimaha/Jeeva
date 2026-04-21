import sys
file_path = "c:/Users/varalakshmi/Desktop/Dental/laravel-app/resources/views/pages/home.blade.php"
with open(file_path, "r", encoding="utf-8") as f:
    content = f.read()

old_arrow = """        <div class="why-arrow d-none-mobile">
          <svg preserveAspectRatio="none" viewBox="0 0 100 40" style="width: 100%; height: 100%;">
            <path d="M0,38 Q50,-5 99,38" fill="none" stroke="#4DB6AC" stroke-width="1.5" vector-effect="non-scaling-stroke" />
          </svg>
          <svg class="why-arrow-head" viewBox="0 0 10 10">
            <polygon points="0,0 10,5 0,10" fill="#4DB6AC" />
          </svg>
        </div>"""

new_arrow = """        <div class="why-arrow d-none-mobile">
          <svg preserveAspectRatio="none" viewBox="0 0 100 20" style="width: 100%; height: auto; overflow: visible;">
            <line x1="0" y1="10" x2="100" y2="10" stroke="#4DB6AC" stroke-width="2" stroke-dasharray="6,6" vector-effect="non-scaling-stroke" />
            <polygon points="95,5 105,10 95,15" fill="#4DB6AC" />
          </svg>
        </div>"""

content = content.replace(old_arrow, new_arrow)

with open(file_path, "w", encoding="utf-8") as f:
    f.write(content)
