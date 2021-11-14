function shma = noise(s,SNR,M)

Eb=1/log2(M);
N0=Eb/(10^(SNR/10));
noise=sqrt(N0/2)*randn(size(s));
shma=s+noise;

end
