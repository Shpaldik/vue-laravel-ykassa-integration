<script setup lang="ts">
import { Head, Link, usePage, router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref, watchEffect } from "vue";

interface Transaction {
  id: number;
  amount: string | number;
  created_at: string;
}

interface TransactionsProp {
  data: Transaction[];
  current_page: number;
  last_page: number;
  prev_page_url: string | null;
  next_page_url: string | null;
}

const page = usePage<{ transactions: TransactionsProp }>();

const transactions = ref<TransactionsProp>(page.props.transactions);

watchEffect(() => {
  transactions.value = page.props.transactions;
});

function changePage(targetPage: number) {
  router.get(
    route("dashboard"),
    { page: targetPage },
    {
      preserveState: true,
      preserveScroll: true,
    }
  );
}
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-[var(--color-text)]">
        {{ $t("profile") }}
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Верхний блок с сообщением -->
        <div
          class="overflow-hidden bg-[var(--color-fill)] shadow-sm sm:rounded-lg transition-colors"
        >
          <div class="p-6 text-[var(--color-text)]">
            {{ $t("welcome") }}
          </div>
        </div>

        <!-- Таблица транзакций -->
        <div
          class="mt-8 bg-[var(--color-bg)] dark:bg-[var(--color-bg)] overflow-hidden shadow-sm sm:rounded-lg transition-colors"
        >
          <div class="px-6 py-4">
            <h3 class="text-lg font-medium text-[var(--color-text)]">
              {{ $t("Last") }}
            </h3>

            <div class="mt-4 overflow-x-auto rounded-xl">
              <table
                class="min-w-full divide-y divide-[var(--color-border)] dark:divide-[var(--color-border)] transition-colors"
              >
                <thead class="bg-[var(--color-fill)] dark:bg-[var(--color-fill)]">
                  <tr>
                    <th
                      class="px-6 py-3 text-left text-xs font-medium text-[var(--color-muted)] uppercase tracking-wider"
                    >
                      {{ $t("ID") }}
                    </th>
                    <th
                      class="px-6 py-3 text-left text-xs font-medium text-[var(--color-muted)] uppercase tracking-wider"
                    >
                      {{ $t("Amount") }} {{ "(₽)" }}
                    </th>
                    <th
                      class="px-6 py-3 text-left text-xs font-medium text-[var(--color-muted)] uppercase tracking-wider"
                    >
                      {{ $t("Date") }}
                    </th>
                  </tr>
                </thead>
                <tbody
                  class="bg-[var(--color-fill)] dark:bg-[var(--color-bg)] divide-y divide-[var(--color-border)] dark:divide-[var(--color-border)] transition-colors"
                >
                  <tr v-for="tx in transactions.data" :key="tx.id">
                    <td
                      class="px-6 py-4 whitespace-nowrap text-sm text-[var(--color-text)]"
                    >
                      {{ tx.id }}
                    </td>
                    <td
                      class="px-6 py-4 whitespace-nowrap text-sm text-[var(--color-text)]"
                    >
                      {{ parseFloat(tx.amount as string).toFixed(2) }}
                    </td>
                    <td
                      class="px-6 py-4 whitespace-nowrap text-sm text-[var(--color-text)]"
                    >
                      {{
                        new Date(tx.created_at).toLocaleString("ru-RU", {
                          day: "2-digit",
                          month: "2-digit",
                          year: "numeric",
                          hour: "2-digit",
                          minute: "2-digit",
                        })
                      }}
                    </td>
                  </tr>
                  <tr v-if="transactions.data.length === 0">
                    <td
                      class="px-6 py-4 whitespace-nowrap text-sm text-[var(--color-muted)]"
                      colspan="3"
                    >
                      {{ $t("Пополнений не найдено") }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="mt-4 flex justify-between items-center">
              <button
                :disabled="!transactions.prev_page_url"
                @click="changePage(transactions.current_page - 1)"
                class="px-4 py-2 bg-[var(--color-fill)] dark:bg-[var(--color-bg)] text-[var(--color-text)] rounded disabled:opacity-50 transition-colors"
              >
                {{ $t("Previous") }}
              </button>

              <span class="text-sm text-[var(--color-muted)]">
                {{ $t("Page") }} {{ transactions.current_page }} {{ $t("From") }}
                {{ transactions.last_page }}
              </span>

              <button
                :disabled="!transactions.next_page_url"
                @click="changePage(transactions.current_page + 1)"
                class="px-4 py-2 bg-[var(--color-fill)] dark:bg-[var(--color-bg)] text-[var(--color-text)] rounded disabled:opacity-50 transition-colors"
              >
                {{ $t("Next") }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
