# public/python/generate_article.py
import google.generativeai as genai
import sys
import json

genai.configure(api_key="AIzaSyCRS0moBaz4yW3vLopp1eOyY4a9KCusci8")

topik = sys.argv[1]

model = genai.GenerativeModel("gemini-1.5-flash")
prompt = f"""
    Anda adalah seorang content writer yang handal, dapat menulis postingan blog yang berkualitas dan sesuai dengan data atau bukan karangan. Saya menginginkan sebuah postingan blog yang memiliki dampak besar terhadap visibilitas di mesin pencari.

    Maka dari itu buatkan postingan blog dengan topik mengandung keyword: {topik}.
    Buatkan postingan blog menjadi menarik dengan format yang SEO-friendly.
"""

try:
    response = model.generate_content(prompt)
    artikel = response.text.replace("#", "")
    print(json.dumps({"post": post}))
except Exception as e:
    print(json.dumps({"error": str(e)}))
