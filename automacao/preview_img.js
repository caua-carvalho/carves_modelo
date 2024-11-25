
function previewImagem(event) {
    const imagemPreview = document.getElementById('imagem-preview');
    imagemPreview.src = URL.createObjectURL(event.target.files[0]);
    imagemPreview.onload = () => {
        URL.revokeObjectURL(imagemPreview.src); // Libera memória
    };
}
