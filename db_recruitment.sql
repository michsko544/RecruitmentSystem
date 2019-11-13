USE [master]
GO
/****** Object:  Database [MyCompany]    Script Date: 13.11.2019 22:09:18 ******/
CREATE DATABASE [MyCompany]
 CONTAINMENT = NONE
 ON  PRIMARY
( NAME = N'MyCompany', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL12.MSSQLSERVER\MSSQL\DATA\MyCompany.mdf' , SIZE = 5120KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON
( NAME = N'MyCompany_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL12.MSSQLSERVER\MSSQL\DATA\MyCompany_log.ldf' , SIZE = 1024KB , MAXSIZE = 2048GB , FILEGROWTH = 10%)
GO
ALTER DATABASE [MyCompany] SET COMPATIBILITY_LEVEL = 120
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [MyCompany].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [MyCompany] SET ANSI_NULL_DEFAULT OFF
GO
ALTER DATABASE [MyCompany] SET ANSI_NULLS OFF
GO
ALTER DATABASE [MyCompany] SET ANSI_PADDING OFF
GO
ALTER DATABASE [MyCompany] SET ANSI_WARNINGS OFF
GO
ALTER DATABASE [MyCompany] SET ARITHABORT OFF
GO
ALTER DATABASE [MyCompany] SET AUTO_CLOSE OFF
GO
ALTER DATABASE [MyCompany] SET AUTO_SHRINK OFF
GO
ALTER DATABASE [MyCompany] SET AUTO_UPDATE_STATISTICS ON
GO
ALTER DATABASE [MyCompany] SET CURSOR_CLOSE_ON_COMMIT OFF
GO
ALTER DATABASE [MyCompany] SET CURSOR_DEFAULT  GLOBAL
GO
ALTER DATABASE [MyCompany] SET CONCAT_NULL_YIELDS_NULL OFF
GO
ALTER DATABASE [MyCompany] SET NUMERIC_ROUNDABORT OFF
GO
ALTER DATABASE [MyCompany] SET QUOTED_IDENTIFIER OFF
GO
ALTER DATABASE [MyCompany] SET RECURSIVE_TRIGGERS OFF
GO
ALTER DATABASE [MyCompany] SET  DISABLE_BROKER
GO
ALTER DATABASE [MyCompany] SET AUTO_UPDATE_STATISTICS_ASYNC OFF
GO
ALTER DATABASE [MyCompany] SET DATE_CORRELATION_OPTIMIZATION OFF
GO
ALTER DATABASE [MyCompany] SET TRUSTWORTHY OFF
GO
ALTER DATABASE [MyCompany] SET ALLOW_SNAPSHOT_ISOLATION OFF
GO
ALTER DATABASE [MyCompany] SET PARAMETERIZATION SIMPLE
GO
ALTER DATABASE [MyCompany] SET READ_COMMITTED_SNAPSHOT OFF
GO
ALTER DATABASE [MyCompany] SET HONOR_BROKER_PRIORITY OFF
GO
ALTER DATABASE [MyCompany] SET RECOVERY SIMPLE
GO
ALTER DATABASE [MyCompany] SET  MULTI_USER
GO
ALTER DATABASE [MyCompany] SET PAGE_VERIFY CHECKSUM
GO
ALTER DATABASE [MyCompany] SET DB_CHAINING OFF
GO
ALTER DATABASE [MyCompany] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF )
GO
ALTER DATABASE [MyCompany] SET TARGET_RECOVERY_TIME = 0 SECONDS
GO
ALTER DATABASE [MyCompany] SET DELAYED_DURABILITY = DISABLED
GO
USE [MyCompany]
GO
/****** Object:  Table [dbo].[Administratorzy]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Administratorzy](
	[id_admin] [nchar](10) NULL,
	[nazwa] [nchar](10) NULL,
	[imie] [nchar](10) NULL,
	[nazwisko] [nchar](10) NULL,
	[haslo] [nchar](10) NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Apk]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Apk](
	[id_apl] [nchar](10) NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Aplikacje]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Aplikacje](
	[id_apl] [uniqueidentifier] NOT NULL,
	[id_apk] [uniqueidentifier] NULL,
	[id_dec] [uniqueidentifier] NULL,
	[id_stan] [uniqueidentifier] NULL,
	[id_stat] [uniqueidentifier] NULL,
	[id_lm] [uniqueidentifier] NULL,
 CONSTRAINT [PK_Aplikacje] PRIMARY KEY CLUSTERED
(
	[id_apl] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Aplikacje2]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Aplikacje2](
	[id_apl] [nchar](10) NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Aplikanci]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Aplikanci](
	[id_apk] [uniqueidentifier] NOT NULL,
	[nr_tel] [nchar](10) NULL,
	[email] [nchar](10) NULL,
	[id_cv] [int] NULL,
	[id_miasto] [uniqueidentifier] NULL,
	[id_uzyt] [uniqueidentifier] NULL,
 CONSTRAINT [PK_Aplikanci] PRIMARY KEY CLUSTERED
(
	[id_apk] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Asystenci]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Asystenci](
	[id_asystent] [nchar](10) NULL,
	[nazwa] [nchar](10) NULL,
	[imie] [nchar](10) NULL,
	[nazwisko] [nchar](10) NULL,
	[haslo] [nchar](10) NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Certyfikaty]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Certyfikaty](
	[id_cer] [uniqueidentifier] NOT NULL,
	[tresc] [nchar](300) NULL,
	[id_apk] [uniqueidentifier] NULL,
 CONSTRAINT [PK_Certyfikaty] PRIMARY KEY CLUSTERED
(
	[id_cer] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[CV]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CV](
	[id_cv] [uniqueidentifier] NOT NULL,
	[tresc] [nchar](500) NULL,
	[id_apk] [uniqueidentifier] NULL,
 CONSTRAINT [PK_CV] PRIMARY KEY CLUSTERED
(
	[id_cv] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Decyzje]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Decyzje](
	[id_dec] [uniqueidentifier] NOT NULL,
	[nazw_dec] [nchar](20) NULL,
 CONSTRAINT [PK_Decyzje] PRIMARY KEY CLUSTERED
(
	[id_dec] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Doswiadczenia]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Doswiadczenia](
	[id_dosw] [uniqueidentifier] NOT NULL,
	[praca] [nchar](50) NULL,
	[zatrudniajacy] [nchar](50) NULL,
	[start_pr] [date] NULL,
	[koniec_pr] [date] NULL,
	[miasto] [nchar](20) NULL,
	[opis] [nchar](300) NULL,
	[id_apk] [uniqueidentifier] NULL,
 CONSTRAINT [PK_Doswiadczenia] PRIMARY KEY CLUSTERED
(
	[id_dosw] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Etapy rekrutacji]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Etapy rekrutacji](
	[id_etap] [uniqueidentifier] NOT NULL,
	[nazwa_etapu] [nchar](30) NULL,
	[opis] [nchar](250) NULL,
	[id_apl] [uniqueidentifier] NULL,
 CONSTRAINT [PK_Etapy rekrutacji] PRIMARY KEY CLUSTERED
(
	[id_etap] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Jezyki]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Jezyki](
	[id_jezyk] [uniqueidentifier] NOT NULL,
	[jezyk] [nchar](50) NULL,
 CONSTRAINT [PK_Jezyki] PRIMARY KEY CLUSTERED
(
	[id_jezyk] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Kierownicy]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Kierownicy](
	[id_kierownik] [nchar](10) NULL,
	[nazwa] [nchar](10) NULL,
	[imie] [nchar](10) NULL,
	[nazwisko] [nchar](10) NULL,
	[haslo] [nchar](10) NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[LM]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[LM](
	[id_lm] [uniqueidentifier] NOT NULL,
	[tresc] [nchar](500) NULL,
	[id_apk] [uniqueidentifier] NULL,
 CONSTRAINT [PK_LM] PRIMARY KEY CLUSTERED
(
	[id_lm] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Miasta]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Miasta](
	[id_miasto] [uniqueidentifier] NOT NULL,
	[miejscowosc] [nchar](30) NULL,
 CONSTRAINT [PK_Miasta] PRIMARY KEY CLUSTERED
(
	[id_miasto] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Posiadacze]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Posiadacze](
	[id_posiad] [uniqueidentifier] NOT NULL,
	[poziom] [int] NULL,
	[id_apk] [uniqueidentifier] NULL,
	[id_umiej] [uniqueidentifier] NULL,
 CONSTRAINT [PK_Posiadacze] PRIMARY KEY CLUSTERED
(
	[id_posiad] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Rekruterzy]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Rekruterzy](
	[id_rekruter] [nchar](10) NULL,
	[nazwa] [nchar](10) NULL,
	[imie] [nchar](10) NULL,
	[nazwisko] [nchar](10) NULL,
	[haslo] [nchar](10) NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Role]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Role](
	[id_rola] [uniqueidentifier] NOT NULL,
	[nazwa_r] [nchar](20) NULL,
 CONSTRAINT [PK_Role] PRIMARY KEY CLUSTERED
(
	[id_rola] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Rozmowy]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Rozmowy](
	[id_rozm] [uniqueidentifier] NOT NULL,
	[temat] [nchar](50) NULL,
 CONSTRAINT [PK_Rozmowy] PRIMARY KEY CLUSTERED
(
	[id_rozm] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Stanowiska]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Stanowiska](
	[id_stan] [uniqueidentifier] NOT NULL,
	[pozycja] [nchar](50) NULL,
	[opis] [nchar](300) NULL,
	[id_apl] [uniqueidentifier] NULL,
 CONSTRAINT [PK_Stanowiska] PRIMARY KEY CLUSTERED
(
	[id_stan] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Statusy]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Statusy](
	[id_stat] [uniqueidentifier] NOT NULL,
	[nazw_stat] [nchar](20) NULL,
 CONSTRAINT [PK_Statusy] PRIMARY KEY CLUSTERED
(
	[id_stat] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Szkolenia]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Szkolenia](
	[id_szkolenie] [uniqueidentifier] NOT NULL,
	[szkolenie] [nchar](50) NULL,
	[opis] [nchar](500) NULL,
	[id_apk] [uniqueidentifier] NULL,
 CONSTRAINT [PK_Szkolenia] PRIMARY KEY CLUSTERED
(
	[id_szkolenie] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Szkoly]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Szkoly](
	[id_szkola] [uniqueidentifier] NOT NULL,
	[nazwa] [nchar](30) NULL,
	[specjalizacja] [nchar](30) NULL,
	[start_nauki] [date] NULL,
	[koniec_nauki] [date] NULL,
	[miasto] [nchar](20) NULL,
	[opis] [nchar](300) NULL,
	[id_apk] [uniqueidentifier] NULL,
 CONSTRAINT [PK_Szkoly] PRIMARY KEY CLUSTERED
(
	[id_szkola] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Uczestnicy rozmowy]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Uczestnicy rozmowy](
	[id_ucz_roz] [uniqueidentifier] NOT NULL,
	[id_rozm] [uniqueidentifier] NULL,
	[id_uzyt] [uniqueidentifier] NULL,
 CONSTRAINT [PK_Uczestnicy rozmowy] PRIMARY KEY CLUSTERED
(
	[id_ucz_roz] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Umiejetnosci]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Umiejetnosci](
	[id_umiej] [uniqueidentifier] NOT NULL,
	[umiejetnosc] [nchar](50) NULL,
 CONSTRAINT [PK_Umiejetnosci] PRIMARY KEY CLUSTERED
(
	[id_umiej] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Uzytkownicy]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Uzytkownicy](
	[id_uzyt] [uniqueidentifier] NOT NULL,
	[nazwa] [nchar](20) NOT NULL,
	[imie] [nchar](20) NULL,
	[nazwisko] [nchar](20) NULL,
	[haslo] [nchar](20) NOT NULL,
	[id_rola] [uniqueidentifier] NULL,
	[id_wiad] [uniqueidentifier] NULL,
 CONSTRAINT [PK_Uzytkownicy] PRIMARY KEY CLUSTERED
(
	[id_uzyt] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Wiadomosci]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Wiadomosci](
	[id_wiad] [uniqueidentifier] NOT NULL,
	[id_nada] [int] NOT NULL,
	[wiad] [char](500) NULL,
	[czas] [datetime] NULL,
	[id_rozm] [uniqueidentifier] NOT NULL,
 CONSTRAINT [PK_Wiadomosci] PRIMARY KEY CLUSTERED
(
	[id_wiad] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Znajomosci]    Script Date: 13.11.2019 22:09:18 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Znajomosci](
	[id_znaj] [uniqueidentifier] NOT NULL,
	[poziom] [int] NULL,
	[id_apk] [uniqueidentifier] NULL,
	[id_jezyk] [uniqueidentifier] NULL,
 CONSTRAINT [PK_Znajomosci] PRIMARY KEY CLUSTERED
(
	[id_znaj] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Index [IX_Wiadomosci]    Script Date: 13.11.2019 22:09:18 ******/
CREATE NONCLUSTERED INDEX [IX_Wiadomosci] ON [dbo].[Wiadomosci]
(
	[id_wiad] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
ALTER TABLE [dbo].[Aplikacje]  WITH CHECK ADD  CONSTRAINT [FK_Aplikacje_Aplikanci] FOREIGN KEY([id_apk])
REFERENCES [dbo].[Aplikanci] ([id_apk])
GO
ALTER TABLE [dbo].[Aplikacje] CHECK CONSTRAINT [FK_Aplikacje_Aplikanci]
GO
ALTER TABLE [dbo].[Aplikacje]  WITH CHECK ADD  CONSTRAINT [FK_Aplikacje_Decyzje] FOREIGN KEY([id_dec])
REFERENCES [dbo].[Decyzje] ([id_dec])
GO
ALTER TABLE [dbo].[Aplikacje] CHECK CONSTRAINT [FK_Aplikacje_Decyzje]
GO
ALTER TABLE [dbo].[Aplikacje]  WITH CHECK ADD  CONSTRAINT [FK_Aplikacje_LM] FOREIGN KEY([id_lm])
REFERENCES [dbo].[LM] ([id_lm])
GO
ALTER TABLE [dbo].[Aplikacje] CHECK CONSTRAINT [FK_Aplikacje_LM]
GO
ALTER TABLE [dbo].[Aplikacje]  WITH CHECK ADD  CONSTRAINT [FK_Aplikacje_Statusy] FOREIGN KEY([id_stat])
REFERENCES [dbo].[Statusy] ([id_stat])
GO
ALTER TABLE [dbo].[Aplikacje] CHECK CONSTRAINT [FK_Aplikacje_Statusy]
GO
ALTER TABLE [dbo].[Aplikanci]  WITH CHECK ADD  CONSTRAINT [FK_Aplikanci_Miasta] FOREIGN KEY([id_miasto])
REFERENCES [dbo].[Miasta] ([id_miasto])
GO
ALTER TABLE [dbo].[Aplikanci] CHECK CONSTRAINT [FK_Aplikanci_Miasta]
GO
ALTER TABLE [dbo].[Aplikanci]  WITH CHECK ADD  CONSTRAINT [FK_Aplikanci_Uzytkownicy] FOREIGN KEY([id_uzyt])
REFERENCES [dbo].[Uzytkownicy] ([id_uzyt])
GO
ALTER TABLE [dbo].[Aplikanci] CHECK CONSTRAINT [FK_Aplikanci_Uzytkownicy]
GO
ALTER TABLE [dbo].[Certyfikaty]  WITH CHECK ADD  CONSTRAINT [FK_Certyfikaty_Aplikanci] FOREIGN KEY([id_apk])
REFERENCES [dbo].[Aplikanci] ([id_apk])
GO
ALTER TABLE [dbo].[Certyfikaty] CHECK CONSTRAINT [FK_Certyfikaty_Aplikanci]
GO
ALTER TABLE [dbo].[CV]  WITH CHECK ADD  CONSTRAINT [FK_CV_Aplikanci] FOREIGN KEY([id_apk])
REFERENCES [dbo].[Aplikanci] ([id_apk])
GO
ALTER TABLE [dbo].[CV] CHECK CONSTRAINT [FK_CV_Aplikanci]
GO
ALTER TABLE [dbo].[Doswiadczenia]  WITH CHECK ADD  CONSTRAINT [FK_Doswiadczenia_Aplikanci] FOREIGN KEY([id_apk])
REFERENCES [dbo].[Aplikanci] ([id_apk])
GO
ALTER TABLE [dbo].[Doswiadczenia] CHECK CONSTRAINT [FK_Doswiadczenia_Aplikanci]
GO
ALTER TABLE [dbo].[Etapy rekrutacji]  WITH CHECK ADD  CONSTRAINT [FK_Etapy rekrutacji_Aplikacje] FOREIGN KEY([id_apl])
REFERENCES [dbo].[Aplikacje] ([id_apl])
GO
ALTER TABLE [dbo].[Etapy rekrutacji] CHECK CONSTRAINT [FK_Etapy rekrutacji_Aplikacje]
GO
ALTER TABLE [dbo].[Posiadacze]  WITH CHECK ADD  CONSTRAINT [FK_Posiadacze_Aplikanci] FOREIGN KEY([id_apk])
REFERENCES [dbo].[Aplikanci] ([id_apk])
GO
ALTER TABLE [dbo].[Posiadacze] CHECK CONSTRAINT [FK_Posiadacze_Aplikanci]
GO
ALTER TABLE [dbo].[Posiadacze]  WITH CHECK ADD  CONSTRAINT [FK_Posiadacze_Umiejetnosci] FOREIGN KEY([id_umiej])
REFERENCES [dbo].[Umiejetnosci] ([id_umiej])
GO
ALTER TABLE [dbo].[Posiadacze] CHECK CONSTRAINT [FK_Posiadacze_Umiejetnosci]
GO
ALTER TABLE [dbo].[Stanowiska]  WITH CHECK ADD  CONSTRAINT [FK_Stanowiska_Aplikacje] FOREIGN KEY([id_apl])
REFERENCES [dbo].[Aplikacje] ([id_apl])
GO
ALTER TABLE [dbo].[Stanowiska] CHECK CONSTRAINT [FK_Stanowiska_Aplikacje]
GO
ALTER TABLE [dbo].[Szkolenia]  WITH CHECK ADD  CONSTRAINT [FK_Szkolenia_Aplikanci] FOREIGN KEY([id_apk])
REFERENCES [dbo].[Aplikanci] ([id_apk])
GO
ALTER TABLE [dbo].[Szkolenia] CHECK CONSTRAINT [FK_Szkolenia_Aplikanci]
GO
ALTER TABLE [dbo].[Szkoly]  WITH CHECK ADD  CONSTRAINT [FK_Szkoly_Aplikanci] FOREIGN KEY([id_apk])
REFERENCES [dbo].[Aplikanci] ([id_apk])
GO
ALTER TABLE [dbo].[Szkoly] CHECK CONSTRAINT [FK_Szkoly_Aplikanci]
GO
ALTER TABLE [dbo].[Uczestnicy rozmowy]  WITH CHECK ADD  CONSTRAINT [FK_Uczestnicy rozmowy_Rozmowy] FOREIGN KEY([id_rozm])
REFERENCES [dbo].[Rozmowy] ([id_rozm])
GO
ALTER TABLE [dbo].[Uczestnicy rozmowy] CHECK CONSTRAINT [FK_Uczestnicy rozmowy_Rozmowy]
GO
ALTER TABLE [dbo].[Uczestnicy rozmowy]  WITH CHECK ADD  CONSTRAINT [FK_Uczestnicy rozmowy_Uzytkownicy] FOREIGN KEY([id_uzyt])
REFERENCES [dbo].[Uzytkownicy] ([id_uzyt])
GO
ALTER TABLE [dbo].[Uczestnicy rozmowy] CHECK CONSTRAINT [FK_Uczestnicy rozmowy_Uzytkownicy]
GO
ALTER TABLE [dbo].[Uzytkownicy]  WITH CHECK ADD  CONSTRAINT [FK_Uzytkownicy_Role] FOREIGN KEY([id_rola])
REFERENCES [dbo].[Role] ([id_rola])
GO
ALTER TABLE [dbo].[Uzytkownicy] CHECK CONSTRAINT [FK_Uzytkownicy_Role]
GO
ALTER TABLE [dbo].[Uzytkownicy]  WITH CHECK ADD  CONSTRAINT [FK_Uzytkownicy_Wiadomosci] FOREIGN KEY([id_wiad])
REFERENCES [dbo].[Wiadomosci] ([id_wiad])
GO
ALTER TABLE [dbo].[Uzytkownicy] CHECK CONSTRAINT [FK_Uzytkownicy_Wiadomosci]
GO
ALTER TABLE [dbo].[Wiadomosci]  WITH CHECK ADD  CONSTRAINT [FK_Wiadomosci_Rozmowy] FOREIGN KEY([id_rozm])
REFERENCES [dbo].[Rozmowy] ([id_rozm])
GO
ALTER TABLE [dbo].[Wiadomosci] CHECK CONSTRAINT [FK_Wiadomosci_Rozmowy]
GO
ALTER TABLE [dbo].[Znajomosci]  WITH CHECK ADD  CONSTRAINT [FK_Znajomosci_Aplikanci] FOREIGN KEY([id_apk])
REFERENCES [dbo].[Aplikanci] ([id_apk])
GO
ALTER TABLE [dbo].[Znajomosci] CHECK CONSTRAINT [FK_Znajomosci_Aplikanci]
GO
ALTER TABLE [dbo].[Znajomosci]  WITH CHECK ADD  CONSTRAINT [FK_Znajomosci_Jezyki] FOREIGN KEY([id_jezyk])
REFERENCES [dbo].[Jezyki] ([id_jezyk])
GO
ALTER TABLE [dbo].[Znajomosci] CHECK CONSTRAINT [FK_Znajomosci_Jezyki]
GO
USE [master]
GO
ALTER DATABASE [MyCompany] SET  READ_WRITE
GO
