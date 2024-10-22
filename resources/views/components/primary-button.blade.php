<button {{ $attributes->merge(['type' => 'submit', 'class' => '']) }}>
    {{ $slot }}
</button>

<style>
.inputer {
    background: var(--blue);
    border-radius: 10px;
    padding: 10px 20px;
    color: var(--colorPrimary);
    border: 1px solid var(--colorBlack);
    border-bottom: 4px solid var(--colorBlack);
}
</style>