function bits = demapper(symbola,M,gray)

if (gray==1)
    symbola = gray2bin(symbola,'pam',M);
end
M_bits = dec2bin(symbola);
bits = reshape(M_bits',log2(M)*length(symbola),1);
bits = str2num(bits);

end
