# Museum Emotion AI Platform

An end-to-end platform for **real-time visitor emotion recognition** in museums, using a **CNN** at the edge (Raspberry Pi), a **Flutter** mobile app, a **Laravel** web dashboard/API, and **Node-RED** as a lightweight integration layer.

## 🧭 Repository Structure

```
.
├─ mobile-app/        # Flutter app (camera + TFLite inference + HTTP POST)
├─ python-edge/       # Raspberry Pi Python scripts (face detection + Keras .h5)
├─ web-dashboard/     # Laravel API + dashboard (ingest, store, visualize)
└─ README.md
```

## ✨ Features

* Emotion classes: Angry, Disgust, Fear, Happy, Sad, Surprise, Neutral
* On-device inference (low latency, privacy)
* Live data flow via Node-RED to Laravel API
* Analytics dashboard (Chart.js), time filters, exports

---

## ⚙️ Requirements (high level)

* **Python 3.9+** on Raspberry Pi, OpenCV, TensorFlow/Keras
* **Flutter 3.x** + Android SDK
* **PHP 8.2+**, **Composer**, **MySQL/MariaDB**
* **Node-RED** 3.x

---

## 🚀 Quickstart

### 1) Python Edge (`/python-edge`)

> On Raspberry Pi (or a dev machine with a webcam)

```bash
cd python-edge
python -m venv .venv
# Windows: .\.venv\Scripts\activate
# Linux/Mac:
source .venv/bin/activate

pip install -r requirements.txt
python main.py  # adjust if your entrypoint has a different name
```

**I/O expectations**

* Reads from USB/CSI camera.
* Loads Keras model: `emotion_detection_model_improved.h5`.
* Sends JSON to Node-RED or directly to Laravel:

```json
{
  "artwork_id": "A-102",
  "emotion": "Happy",
  "confidence": 0.87,
  "timestamp": "2025-08-08T20:15:00Z"
}
```

> Using **Node-RED** as a relay? Configure the Python script’s POST target to `http://<NODE_RED_HOST>:<PORT>/ingest`.

---

### 2) Mobile App (`/mobile-app`)

> Flutter app with TFLite inference

```bash
cd mobile-app
flutter clean
flutter pub get
flutter run
```

**Setup notes**

* Place `model.tflite` under `assets/` and register it in `pubspec.yaml`.
* Preprocess:

  * Detect/crop face
  * Convert to grayscale 48×48, normalize
  * Shape tensor `[1, 48, 48, 1]`
* POST to API:

  * Endpoint: `http://<SERVER>/api/receive-data`
  * Payload like the JSON above

> Some devices need camera frame rotation — apply before inference.

---

### 3) Web Dashboard (`/web-dashboard`)

> Laravel API + dashboard

```bash
cd web-dashboard
cp .env.example .env
composer install
php artisan key:generate

# Edit DB settings in .env:
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=emotions
# DB_USERNAME=root
# DB_PASSWORD=secret

php artisan migrate
php artisan serve   # typically http://127.0.0.1:8000
```

**API**

* Ingest endpoint: `POST /api/receive-data`
* Fields: `artwork_id, emotion, confidence, timestamp`
* Stored in `emotions` table (migrations included)
* UI: Blade + Chart.js (real-time feed, trends, filters)
* Exports: CSV/Excel (if the project includes exporters)

---

## 🔌 Node-RED Integration:

**Typical flow**

1. **HTTP IN** `POST /ingest`
2. **Function** (validate/normalize JSON)
3. **HTTP Request** (POST) → `http://<LARAVEL_HOST>/api/receive-data`
4. **Debug** (dev visibility)

**Function node example (JavaScript)**

```js
// expects payload with: artwork_id, emotion, confidence, timestamp
let p = msg.payload;
if (typeof p === 'string') {
  p = JSON.parse(p);
}
msg.headers = { 'Content-Type': 'application/json' };
msg.payload = {
  artwork_id: p.artwork_id,
  emotion: p.emotion,
  confidence: p.confidence,
  timestamp: p.timestamp
};
return msg;
```

---

## 🧠 Model & Training (summary)

* **Framework:** TensorFlow 2.19 (Keras)
* **Dataset:** FER2013 (48×48 grayscale, \~36k images)
* **Batch Size:** 32 — **Epochs:** up to 100
* **Callbacks:** EarlyStopping(patience=15), ReduceLROnPlateau(patience=5)
* **Best model saved as:** `emotion_detection_model_improved.h5`

### TFLite conversion (for the mobile app)

```python
import tensorflow as tf
model = tf.keras.models.load_model("emotion_detection_model_improved.h5")
converter = tf.lite.TFLiteConverter.from_keras_model(model)
# Optional optimization:
# converter.optimizations = [tf.lite.Optimize.DEFAULT]
tflite_model = converter.convert()
open("model.tflite", "wb").write(tflite_model)
```

---

## 🔒 Security Best Practices

* Never commit secrets: `.env`, keystores, API keys
* Protect `POST /api/receive-data` with an API key/token or IP allow-list (Node-RED host)
* Validate/strictly type request fields (Laravel Request Validation)

---

## 🧪 Local Smoke Test (without Node-RED)

```bash
curl -X POST http://127.0.0.1:8000/api/receive-data \
  -H "Content-Type: application/json" \
  -d '{
    "artwork_id":"A-102",
    "emotion":"Happy",
    "confidence":0.87,
    "timestamp":"2025-08-08T20:15:00Z"
  }'
```

---

### Submission checklist

* `.gitignore` in each module:

  * `python-edge/.gitignore` (env, **pycache**, etc.)
  * `mobile-app/.gitignore` (build, .dart\_tool, etc.)
  * `web-dashboard/.gitignore` (vendor, .env, logs, etc.)
* On Windows, prefer `php artisan serve` for Laravel or point Apache’s DocumentRoot to `web-dashboard/public`.
