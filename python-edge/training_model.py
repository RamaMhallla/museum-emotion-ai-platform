import os
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '2'  # Suppress TensorFlow logging

import tensorflow as tf
import cv2
import numpy as np
from tensorflow.keras.preprocessing.image import img_to_array

# Load the trained emotion detection model
model = tf.keras.models.load_model('emotion_detection_model_improved (2).h5')

# Load the face detection classifier
face_classifier = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_frontalface_default.xml')

# Define emotion labels (make sure these match your model's output)
emotion_labels = ['Angry', 'Disgust', 'Fear', 'Happy', 'Sad', 'Surprise', 'Neutral']

# Initialize video capture from the default camera (index 0)
cap = cv2.VideoCapture(0)

if not cap.isOpened():
    print("Error: Could not open video capture.")
    exit()

while True:
    # Read a frame from the camera
    ret, frame = cap.read()
    if not ret:
        print("Error: Failed to capture frame.")
        break  # Exit loop if frame reading fails

    # Convert the frame to grayscale for face detection
    gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)

    # Detect faces in the grayscale frame
    faces = face_classifier.detectMultiScale(gray, 1.3, 5)

    # Process each detected face
    for (x, y, w, h) in faces:
        # Draw a rectangle around the face
        cv2.rectangle(frame, (x, y), (x + w, y + h), (255, 0, 0), 2)

        # Extract the region of interest (ROI) for the face in grayscale
        roi_gray = gray[y:y + h, x:x + w]

        # Resize the ROI to the input size expected by the model (e.g., 48x48)
        roi_gray = cv2.resize(roi_gray, (48, 48), interpolation=cv2.INTER_AREA)

        # Preprocess the ROI for the model
        if np.sum([roi_gray]) != 0:  # Check if the ROI is not empty
            roi = roi_gray.astype('float') / 255.0  # Normalize pixel values to [0, 1]
            roi = img_to_array(roi)  # Convert to an array
            roi = np.expand_dims(roi, axis=0)  # Add a batch dimension

            # Predict the emotion using the model
            prediction = model.predict(roi)[0]
            label = emotion_labels[prediction.argmax()]  # Get the label with the highest probability

            # Display the emotion label and bounding box on the frame
            cv2.putText(frame, label, (x, y - 10), cv2.FONT_HERSHEY_SIMPLEX, 1, (0, 255, 0), 2)

    # Display the resulting frame
    cv2.imshow('Emotion Recognition', frame)

    # Exit the loop if the 'q' key is pressed
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# Release the video capture object and close all windows
cap.release()
cv2.destroyAllWindows()