<template>
  <section id="contact" class="section-container bg-secondary/30">
    <h2 ref="titleRef" class="section-title">
      Travaillons <span class="text-gradient">Ensemble</span>
    </h2>
    <p ref="subtitleRef" class="section-subtitle">
      Vous avez un projet en tête ? Parlons-en !
    </p>

    <div class="max-w-3xl mx-auto mt-12">
      <form
        ref="formRef"
        @submit.prevent="handleSubmit"
        class="card space-y-6 opacity-0"
      >
        <!-- Name -->
        <div>
          <label for="name" class="block text-sm font-medium mb-2">Nom complet</label>
          <input
            id="name"
            v-model="form.name"
            type="text"
            required
            class="w-full px-4 py-3 bg-primary border border-gray-700 rounded-lg focus:outline-none focus:border-accent transition-colors"
            placeholder="John Doe"
          />
        </div>

        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium mb-2">Email</label>
          <input
            id="email"
            v-model="form.email"
            type="email"
            required
            class="w-full px-4 py-3 bg-primary border border-gray-700 rounded-lg focus:outline-none focus:border-accent transition-colors"
            placeholder="john@example.com"
          />
        </div>

        <!-- Subject -->
        <div>
          <label for="subject" class="block text-sm font-medium mb-2">Sujet</label>
          <input
            id="subject"
            v-model="form.subject"
            type="text"
            required
            class="w-full px-4 py-3 bg-primary border border-gray-700 rounded-lg focus:outline-none focus:border-accent transition-colors"
            placeholder="Développement d'un site web"
          />
        </div>

        <!-- Message -->
        <div>
          <label for="message" class="block text-sm font-medium mb-2">Message</label>
          <textarea
            id="message"
            v-model="form.message"
            required
            rows="6"
            class="w-full px-4 py-3 bg-primary border border-gray-700 rounded-lg focus:outline-none focus:border-accent transition-colors resize-none"
            placeholder="Décrivez votre projet..."
          ></textarea>
        </div>

        <!-- Submit Button -->
        <div class="flex flex-col sm:flex-row gap-4 items-center">
          <button
            type="submit"
            :disabled="isSubmitting"
            class="btn-primary w-full sm:w-auto disabled:opacity-50 disabled:cursor-not-allowed"
          >
            <span v-if="!isSubmitting">Envoyer le message</span>
            <span v-else>Envoi en cours...</span>
          </button>

          <!-- Status Messages -->
          <div v-if="submitStatus === 'success'" class="text-green-400 text-sm">
            ✓ Message envoyé avec succès !
          </div>
          <div v-if="submitStatus === 'error'" class="text-red-400 text-sm">
            ✗ Erreur lors de l'envoi. Réessayez.
          </div>
        </div>
      </form>

      <!-- Contact Info -->
      <div ref="contactInfoRef" class="grid md:grid-cols-3 gap-6 mt-12 opacity-0">
        <div class="card text-center">
          <svg class="w-8 h-8 text-accent mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
          </svg>
          <h4 class="font-semibold mb-1">Email</h4>
          <a href="mailto:contact@example.com" class="text-sm text-gray-400 hover:text-accent transition-colors">
            contact@gaetan-langlet.fr
          </a>
        </div>

        <div class="card text-center">
          <svg class="w-8 h-8 text-accent mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          <h4 class="font-semibold mb-1">Localisation</h4>
          <p class="text-sm text-gray-400">France</p>
        </div>

        <div class="card text-center">
          <svg class="w-8 h-8 text-accent mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
          </svg>
          <h4 class="font-semibold mb-1">Statut</h4>
          <p class="text-sm text-green-400">Disponible pour de nouveaux projets</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
import emailjs from '@emailjs/browser'

gsap.registerPlugin(ScrollTrigger)

const titleRef = ref()
const subtitleRef = ref()
const formRef = ref()
const contactInfoRef = ref()

const isSubmitting = ref(false)
const submitStatus = ref(null)

const form = reactive({
  name: '',
  email: '',
  subject: '',
  message: '',
})

const handleSubmit = async () => {
  isSubmitting.value = true
  submitStatus.value = null

  try {
    // EmailJS configuration
    // Replace with your EmailJS credentials
    // await emailjs.send(
    //   'YOUR_SERVICE_ID',
    //   'YOUR_TEMPLATE_ID',
    //   {
    //     from_name: form.name,
    //     from_email: form.email,
    //     subject: form.subject,
    //     message: form.message,
    //   },
    //   'YOUR_PUBLIC_KEY'
    // )

    // Simulated success for demo
    await new Promise(resolve => setTimeout(resolve, 1000))

    submitStatus.value = 'success'

    // Reset form
    form.name = ''
    form.email = ''
    form.subject = ''
    form.message = ''

    // Reset status after 5 seconds
    setTimeout(() => {
      submitStatus.value = null
    }, 5000)
  } catch (error) {
    console.error('EmailJS error:', error)
    submitStatus.value = 'error'

    setTimeout(() => {
      submitStatus.value = null
    }, 5000)
  } finally {
    isSubmitting.value = false
  }
}

onMounted(() => {
  // Initialize EmailJS (uncomment and add your public key)
  // emailjs.init('YOUR_PUBLIC_KEY')

  // Animate title
  gsap.from(titleRef.value, {
    scrollTrigger: {
      trigger: titleRef.value,
      start: 'top 80%',
    },
    opacity: 0,
    y: 50,
    duration: 0.8,
    ease: 'power3.out',
  })

  gsap.from(subtitleRef.value, {
    scrollTrigger: {
      trigger: subtitleRef.value,
      start: 'top 80%',
    },
    opacity: 0,
    y: 30,
    duration: 0.8,
    delay: 0.2,
    ease: 'power3.out',
  })

  // Animate form
  gsap.to(formRef.value, {
    scrollTrigger: {
      trigger: formRef.value,
      start: 'top 80%',
    },
    opacity: 1,
    y: 0,
    duration: 0.8,
    delay: 0.3,
    ease: 'power3.out',
  })

  // Animate contact info
  gsap.to(contactInfoRef.value, {
    scrollTrigger: {
      trigger: contactInfoRef.value,
      start: 'top 85%',
    },
    opacity: 1,
    y: 0,
    duration: 0.8,
    delay: 0.4,
    ease: 'power3.out',
  })
})
</script>
