function r = apodiam_PAM(shma)

Tsymbol=40;
Tsample=1;
Tc=4;
Es=1;
fc=1/Tc;
t=1:Tsymbol;
ferousa=sqrt(2*Es/Tsymbol)*cos(2*pi*fc*t)';
r=shma*ferousa;

end
