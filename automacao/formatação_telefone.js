function formatarTelefone(input) {
    let telefone = input.value.replace(/\D/g, ''); // Remove caracteres não numéricos
    if (telefone.length > 11) telefone = telefone.slice(0, 11); // Limita a 11 dígitos
    // Adiciona máscara (XX) XXXXX-XXXX
    if (telefone.length > 6) {
        input.value = `(${telefone.slice(0, 2)}) ${telefone.slice(2, 7)}-${telefone.slice(7)}`;
    } else if (telefone.length >= 2) {
        input.value = `(${telefone.slice(0, 2)}) ${telefone.slice(2)}`;
    } else {
        input.value = telefone;
    }
}