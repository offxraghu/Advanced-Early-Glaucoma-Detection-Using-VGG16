# Advanced-Early-Glaucoma-Detection-Using-VGG16

## Overview

This project, Glaucoma Detection Using VGG16, was developed as our culminating academic endeavor during the final semester of the B.Tech program in Artificial Intelligence and Machine Learning at Srinivas University Institute of Engineering and Technology.

The core objective of this project is to facilitate the early identification of glaucoma, a severe ocular condition that can result in irreversible vision loss, by employing an automated image classification approach rooted in deep learning. Through the strategic application of transfer learning with the VGG16 convolutional neural network, our model strives to accurately and efficiently categorize retinal fundus images into either glaucomatous or non-glaucomatous classes.

## Problem Statement

Glaucoma is a "silent" eye disease that slowly damages the nerve connecting your eye to your brain, often without you even noticing until it's too late. This damage can't be fixed and leads to permanent vision loss. Catching it early is incredibly important, but it's tough because there are usually no clear symptoms in the beginning. Our project aims to help eye doctors and specialists by giving them an AI-based system that can aid in early glaucoma detection through analyzing eye images. This system provides a vital tool to support them in identifying this disease sooner, potentially saving people's sight.

## Objectives

To develop an efficient and reliable AI model for identifying glaucoma in eye scans.
To leverage pre-trained deep learning models, such as VGG16, to overcome the challenge of small and specialized medical datasets.
To provide a supplementary diagnostic tool that assists ophthalmologists in making more informed and timely decisions.
To validate the effectiveness of convolutional neural networks (CNNs) in distinguishing between healthy and glaucomatous retinal images.
To create a system that reduces the manual burden on eye-care professionals for initial glaucoma screening.

## Dataset

- **Type**: Retinal fundus images
- **Format**: JPEG/PNG
- **Classes**: Glaucomatous, Non-Glaucomatous
- **Preprocessing**:
  - Resizing images to 224x224 pixels
  - Normalization and augmentation
  - Splitting into training, validation, and test sets

> *Note: The dataset used is anonymized and sourced from publicly available medical datasets.*

## Technologies Used

- **Programming Language**: Python
- **Deep Learning Framework**: TensorFlow & Keras
- **Model Architecture**: VGG16 (Pre-trained on ImageNet)
- **Image Processing**: OpenCV
- **Development Tools**: Jupyter Notebook, Google Colab / PyCharm

## Model Architecture

**A transfer learning approach** was adopted, starting with a pre-trained VGG16 model where the convolutional base was kept immutable.
**New fully connected layers** were introduced to stop the frozen base to perform binary classification.
**Dropout layers** were strategically placed to mitigate overfitting.
Model training employed the **binary cross-entropy loss function**.
Performance was rigorously evaluated through **accuracy, precision, recall, and F1-score**.

## Training and Evaluation

**Optimization**: The Adam optimizer was used to fine-tune the model's parameters.
**Learning Metric**: Binary Cross-Entropy served as the loss function to guide the learning process.
**Performance Measurement**: The model's effectiveness was assessed using Accuracy, Precision, Recall, and F1-Score.
**Robustness Techniques**: Early Stopping: Training was halted automatically when performance on a separate validation set stopped improving, preventing overfitting.
**Model Checkpointing**: The best-performing version of the model during training was saved.
**Data Augmentatio**n: Techniques like rotations, flips, and zooms were applied to the training images to increase data diversity and improve generalization.
**Outcome**: The model demonstrated stable and reliable performance across both the validation and unseen test datasets.

## Results

**Test Accuracy**: Our model achieved approximately 93% accuracy on unseen test images, a figure that can vary slightly based on the specific dataset and how images were prepared.
**Detailed Evaluation**: We used a Confusion Matrix to understand specific prediction successes and errors and ROC-AUC to assess the model's ability to distinguish between healthy and glaucomatous eyes.
**Key Finding**: Importantly, the developed model successfully identified early indicators of glaucoma within retinal fundus images.

## Future Enhancements

**Real-time Deployment**: Implement the model within a web application for direct clinical testing and accessibility.
**Dataset Diversification**: Expand the training dataset to include a wider range of images, enhancing the model's generalization capabilities.
**Architectural Alternatives**: Evaluate the effectiveness of other state-of-the-art deep learning architectures (e.g., ResNet50, EfficientNet) for improved performance.
**Clinical Partnership**: Collaborate closely with medical institutions to obtain valuable feedback and conduct rigorous validation in real-world scenarios.


## Conclusion

This project clearly shows how powerful deep learning, especially using transfer learning, can be for finding diseases earlier in healthcare. By automating the detection of glaucoma, we hope to give medical professionals a helpful tool and play a part in better preventive eye care for everyone.


## Contributors

- G Raghavendra 
- Aishwarya Ishwar Naik
- Anusha Narayan Naik
- Joshmi K Joy 
