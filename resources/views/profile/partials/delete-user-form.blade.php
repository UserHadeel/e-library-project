<section class="space-y-6">

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100" style="margin-top: 60px; font-size:23px; font-weight: bold">
            {{ ('حذف حساب') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400" style="font-size: 18px;">
            {{ ('بمجرد حذف حسابك، سيتم حذف جميع موارده وبياناته نهائيًا. قبل حذف حسابك، يرجى تنزيل أي بيانات أو معلومات ترغب في الاحتفاظ بها.') }}
        </p>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ ('حذف حساب') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6" style="margin-top: 10%;">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ ('هل انت متأكد انك تريد حذف حسابك؟') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ ('بمجرد حذف حسابك، سيتم حذف جميع بياناته نهائيًا. الرجاء إدخال كلمة المرور الخاصة بك لتأكيد رغبتك في حذف حسابك نهائيًا.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ ('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"

                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
            <x-danger-button class="ml-3">
                    {{ __('حذف') }}
                </x-danger-button>

                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ ('إلغاء') }}
                </x-secondary-button>


            </div>
        </form>
    </x-modal>
</section>
