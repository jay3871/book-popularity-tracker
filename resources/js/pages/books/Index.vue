<script setup>
import { router, Head } from '@inertiajs/vue3'
import { ref, watch } from 'vue'
import debounce from 'lodash/debounce' // Aiztures funkcija, lai nesūtītu pieprasījumus katru rakstīšanas reizi
import { useToast, POSITION } from 'vue-toastification';

// Saņemam datus no Laravel puses
const props = defineProps({
  books: Array, // Grāmatu saraksts
  filters: Object // Lietotāja pašreizējie filtri (meklēšana un kārtošana)
})

// Meklēšanas un kārtošanas filtri (reaģē uz izmaiņām)
const search = ref(props.filters.search || '')
const sort = ref(props.filters.sort ?? '')

// Automātiski nosūta filtru pieprasījumu, kad lietotājs kaut ko meklē vai filtrē (ar aizturi)
watch([search, sort], debounce(() => {
  router.get('/books', {
    search: search.value,
    sort: sort.value
  }, {
    preserveScroll: true, // Saglabājam esošo lapas scroll pozīciju
    preserveState: true, // Saglabājam komponentes stāvokli
    replace: true // Nesaglabā pa jaunam, bet aizvieto pārlūkprogrammas vēsturē
  })
}, 300)) // 300ms aizture

const toast = useToast() // Inicializējam toast

// Pirkšanas funkcija – pievieno pirkumu un atjauno sarakstu
const purchaseBook = (id) => {
  router.post(`/books/${id}/purchase`, {}, {
    preserveScroll: true,
    onSuccess: () => {
      // Pēc pirkuma pārģenerējam tikai grāmatu datus
      router.reload({ only: ['books'] })

      // Parādām veiksmīgu pirkuma ziņojumu
      toast.success('Grāmata veiksmīgi iegādāta!', { position: POSITION.BOTTOM_RIGHT })
    }
  })
}
</script>

<template>
  <Head title="Grāmatu saraksts" />

  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-center sm:text-left">Grāmatu saraksts</h1>

    <!-- Filtrēšanas un meklēšanas lauki -->
    <div class="flex flex-col sm:flex-row sm:items-center gap-4 mb-6">
      <input
        v-model="search"
        type="text"
        placeholder="Meklēt pēc nosaukuma vai autora"
        class="border p-2 rounded w-full sm:flex-1"
      />

      <select v-model="sort" class="border p-2 rounded w-full sm:w-auto">
        <option value="" selected>— Bez kārtošanas —</option>
        <option value="monthly">Populārākās šomēnes</option>
      </select>
    </div>

    <!-- Grāmatu saraksts -->
    <div v-if="books.length" class="space-y-4">
      <div
        v-for="book in books"
        :key="book.id"
        class="border rounded-lg p-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 shadow-sm hover:shadow transition"
      >
        <div class="flex-1">
          <h2 class="text-lg font-semibold">{{ book.title }}</h2>
          <p class="text-sm text-gray-600">
            Autori:
            <span v-if="book.authors.length">
              {{ book.authors.map(a => a.name).join(', ') }}
            </span>
            <span v-else>—</span>
          </p>
          <p class="text-sm mt-1">
            🛒 Kopā: {{ book.total_purchases }} | Šomēnes: {{ book.monthly_purchases }}
          </p>
        </div>

        <button
          @click="purchaseBook(book.id)"
          class="bg-green-600 hover:bg-green-700 transition text-white px-4 py-2 rounded w-full sm:w-auto text-center cursor-pointer"
        >
          Pirkt
        </button>
      </div>
    </div>

    <!-- Ja nav rezultātu -->
    <div v-else class="text-gray-600 text-center mt-6">
      Nav atrasta neviena grāmata.
    </div>
  </div>
</template>