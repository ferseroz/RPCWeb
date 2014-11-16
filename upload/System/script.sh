#!/bin/bash
sudo passwd <<- end
        root
        root
end


sudo rm /etc/apt/sources.list
sudo echo "deb http://mirror1.ku.ac.th/raspbian/raspbian/ wheezy main contrib non-free rpi" >> /etc/apt/sources.list
sudo apt-get -y update <<- end
        Y
end
sudo apt-get -y upgrade <<- end
        Y
end
sudo apt-get install -y openssl shellinabox openssh-server openjdk-7-jdk gcc g++ build-essential python-dev python-mpi python-scipy python-numpy
#ssh-keygen -t rsa -P "" <<- end
#        yes
#end
ssh-keygen -t rsa -N "" -f ~/.ssh/id_rsa
cat ~/.ssh/id_rsa.pub >> ~/.ssh/authorized_keys
ssh-agent


#update-alternatives --config java <<- end
#        2
#end

wget https://bootstrap.pypa.io/get-pip.py
python get-pip.py
sudo apt-get -y install mpich2
pip install mpi4py
python setup.py install

sudo addgroup hadoop

sudo adduser student --ingroup hadoop --gecos "" --disabled-password
echo "student:student" | sudo chpasswd
#adduser --ingroup hadoop student <<- end
#        student
#        student
#        \n
#        \n
#        \n
#        \n
#        \n
#        Y
#end


cd ~
wget http://www.cs.rit.edu/~ark/pj2_20141107.jar
mv pj2_20141107.jar /usr/lib/pj2.jar

wget http://mirror.issp.co.th/apache/hadoop/common/hadoop-1.2.1/hadoop-1.2.1.tar.gz
tar vxzf hadoop-1.2.1.tar.gz -C /usr/local
mv /usr/local/hadoop-1.2.1/ /usr/local/hadoop
sed -i '1i export JAVA_HOME=/usr/lib/jvm/java-7-openjdk-armhf\nexport HADOOP_INSTALL=/usr/local/hadoop\nexport PATH=$PATH:$HADOOP_INSTALL/bin\nexport CLASSPATH=.:/usr/lib/pj2.jar' .bashrc
sed -i '1i export JAVA_HOME=/usr/lib/jvm/java-7-openjdk-armhf\nexport HADOOP_HEAPSIZE=272' /usr/local/hadoop/conf/hadoop-env.sh



su student <<- end
    cd /home/student
	ssh-keygen -t rsa -N "" -f ~/.ssh/id_rsa
	cat .ssh/id_rsa.pub >> .ssh/authorized_keys
end

#ssh-keygen -t rsa -P "" <<- end
#        \n
#end

sed -i '1i export JAVA_HOME=/usr/lib/jvm/java-7-openjdk-armhf\nexport HADOOP_INSTALL=/usr/local/hadoop\nexport PATH=$PATH:$HADOOP_INSTALL/bin\nexport CLASSPATH=.:/usr/lib/pj2.jar' .bashrc

