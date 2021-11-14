function symb = mapper(bit,M,gray)

bits_reshape = reshape(bit(1:log2(M)*floor(length(bit)/log2(M))),log2(M),floor(length(bit)/log2(M)))';
symb = bin2dec(num2str(bits_reshape));
if (gray==1)
    symb = bin2gray(symb,'pam',M);
end

end
